CREATE DATABASE ystrategy_bd


CREATE TABLE cad_user(
id int(4) PRIMARY KEY AUTO_INCREMENT,
usuario varchar(20) NOT NULL,
senha varchar(50) NOT NULL,
nome_completo varchar(50),
email varchar(40),
acesso varchar(20),
acao varchar(20)
);

INSERT INTO cad_user(usuario, senha,email,acesso, acao) VALUES ("RUAMA", md5("123456"), "ruma246@gmail.com", "ADMIN", "geral")



CREATE TABLE img(
id int(5) PRIMARY KEY AUTO_INCREMENT not null,
userID int(5) NOT NULL,
path varchar(70) NOT NULL,
extensao varchar(5)
);






DELIMITER //

CREATE TRIGGER atualizar_financas
AFTER INSERT ON transacoes
FOR EACH ROW
BEGIN
    DECLARE tipo_categoria VARCHAR(20);  
    
    SELECT c.tipo INTO tipo_categoria 
    FROM categorias c 
    WHERE c.categoria_id = NEW.categoria_id;
  
    IF tipo_categoria = 'gasto' THEN 
        UPDATE financas_mes 
        SET total_gastos = total_gastos + NEW.amount,
            saldoAtual_amount = (inicial_amount + total_recebimentos - (total_gastos + NEW.amount))
        WHERE mes_id = NEW.mes_id AND userID = NEW.userID;
    ELSEIF tipo_categoria = 'recebimento' THEN 
        UPDATE financas_mes 
        SET total_recebimentos = total_recebimentos + NEW.amount,
            saldoAtual_amount = (inicial_amount + (total_recebimentos + NEW.amount) - total_gastos)
        WHERE mes_id = NEW.mes_id AND userID = NEW.userID;
    END IF;
END//

DELIMITER ;






127.0.0.1/u247855321_ystrategy_bd/		https://auth-db1183.hstgr.io/index.php?route=/database/sql&db=u247855321_ystrategy_bd
Seu comando SQL foi executado com sucesso.

SHOW CREATE PROCEDURE update_is_active_fixos;



update_is_active_fixos	NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION	CREATE DEFINER=`u247855321_ystrategy`@`127.0.0.1` ...	utf8mb4	utf8mb4_unicode_ci	utf8mb4_unicode_ci	




DELIMITER //

CREATE TRIGGER update_saldo_atual AFTER INSERT ON transacoes
FOR EACH ROW
FOLLOWS atualizar_financas
BEGIN
    DECLARE saldo_base DECIMAL(10,2);
    
    -- Calcula o saldo base (recebimentos - gastos)
    SELECT (inicial_amount + total_recebimentos - total_gastos) INTO saldo_base
    FROM financas_mes 
    WHERE userID = NEW.userID AND mes_id = NEW.mes_id;
    
    -- Ajusta o saldo conforme o tipo de transação
    IF NEW.tipo_operacao = 'guardado' THEN
        UPDATE financas_mes 
        SET saldoAtual_amount = saldo_base - NEW.amount
        WHERE userID = NEW.userID AND mes_id = NEW.mes_id;
        
    ELSEIF NEW.tipo_operacao = 'resgatado' THEN
        UPDATE financas_mes 
        SET saldoAtual_amount = saldo_base + NEW.amount
        WHERE userID = NEW.userID AND mes_id = NEW.mes_id;
        
    ELSE
        -- Transação normal (já considerada em total_recebimentos ou total_gastos)
        UPDATE financas_mes 
        SET saldoAtual_amount = saldo_base
        WHERE userID = NEW.userID AND mes_id = NEW.mes_id;
    END IF;
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER update_saldo_atual AFTER INSERT ON transacoes
FOR EACH ROW
FOLLOWS atualizar_financas
BEGIN
    -- Atualização única com cálculo completo
    UPDATE financas_mes fm
    SET saldoAtual_amount = 
        (fm.inicial_amount + fm.total_recebimentos - fm.total_gastos) +
        CASE 
            WHEN NEW.tipo_operacao = 'guardado' THEN -NEW.amount
            WHEN NEW.tipo_operacao = 'resgatado' THEN NEW.amount
            ELSE 0
        END
    WHERE fm.userID = NEW.userID AND fm.mes_id = NEW.mes_id;
END//

DELIMITER ;






DELIMITER //

CREATE TRIGGER atualizar_financas_completo
AFTER INSERT ON transacoes
FOR EACH ROW
BEGIN
    DECLARE tipo_cat VARCHAR(20);
    DECLARE v_inicial_amount DECIMAL(10,2);
    DECLARE v_total_recebimentos DECIMAL(10,2);
    DECLARE v_total_gastos DECIMAL(10,2);
    DECLARE v_metas_ctl DECIMAL(10,2);
    
    -- Obtém os valores atuais do mês financeiro
    SELECT inicial_amount, total_recebimentos, total_gastos, metasAmount_ctl
    INTO v_inicial_amount, v_total_recebimentos, v_total_gastos, v_metas_ctl
    FROM financas_mes 
    WHERE userID = NEW.userID AND mes_id = NEW.mes_id;
    
    -- Verifica o tipo de categoria (para transações normais)
    IF NEW.categoria_id IS NOT NULL THEN
        SELECT c.tipo INTO tipo_cat 
        FROM categorias c 
        WHERE c.categoria_id = NEW.categoria_id;
    END IF;
    
    -- Atualiza os valores conforme o tipo de transação
    UPDATE financas_mes
    SET 
        total_recebimentos = CASE
            WHEN NEW.tipo_operacao = 'resgatado' THEN total_recebimentos
            WHEN NEW.categoria_id IS NOT NULL AND tipo_cat = 'recebimento' THEN total_recebimentos + NEW.amount
            ELSE total_recebimentos
        END,
        total_gastos = CASE
            WHEN NEW.tipo_operacao = 'guardado' THEN total_gastos
            WHEN NEW.categoria_id IS NOT NULL AND tipo_cat = 'gasto' THEN total_gastos + NEW.amount
            ELSE total_gastos
        END,

        metasAmount_ctl = CASE 
            WHEN NEW.tipo_operacao = 'guardado' THEN metasAmount_ctl - NEW.amount
            WHEN NEW.tipo_operacao = 'resgatado' THEN metasAmount_ctl + NEW.amount
            ELSE metasAmount_ctl
        END,


        saldoAtual_amount = 
            v_inicial_amount + 
            CASE
                WHEN NEW.categoria_id IS NOT NULL AND tipo_cat = 'recebimento' THEN v_total_recebimentos + NEW.amount
                ELSE v_total_recebimentos
            END -
            CASE
                WHEN NEW.categoria_id IS NOT NULL AND tipo_cat = 'gasto' THEN v_total_gastos + NEW.amount
                ELSE v_total_gastos
            END + 
            CASE 
                WHEN NEW.tipo_operacao = 'guardado' THEN metasAmount_ctl - NEW.amount
                WHEN NEW.tipo_operacao = 'resgatado' THEN metasAmount_ctl + NEW.amount
                ELSE metasAmount_ctl
            END
            
    WHERE userID = NEW.userID AND mes_id = NEW.mes_id;
END//

DELIMITER ;








DELIMITER //

CREATE TRIGGER atualizar_financas_completo
AFTER INSERT ON transacoes
FOR EACH ROW
BEGIN
    DECLARE tipo_cat VARCHAR(20);
    DECLARE v_inicial DECIMAL(10,2);
    DECLARE v_recebimentos DECIMAL(10,2);
    DECLARE v_gastos DECIMAL(10,2);
    DECLARE v_metas DECIMAL(10,2);
    
    -- Captura valores atuais
    SELECT inicial_amount, total_recebimentos, total_gastos, metasAmount_ctl
    INTO v_inicial, v_recebimentos, v_gastos, v_metas
    FROM financas_mes 
    WHERE userID = NEW.userID AND mes_id = NEW.mes_id;
    
    -- Determina tipo de categoria para transações normais
    IF NEW.categoria_id IS NOT NULL THEN
        SELECT c.tipo INTO tipo_cat FROM categorias c WHERE c.categoria_id = NEW.categoria_id;
    END IF;
    
    -- Atualização única com cálculo consistente
    UPDATE financas_mes
    SET 
        total_recebimentos = IF(NEW.tipo_operacao = 'resgatado', 
                              v_recebimentos, 
                              IF(NEW.categoria_id IS NOT NULL AND tipo_cat = 'recebimento', 
                                 v_recebimentos + NEW.amount, 
                                 v_recebimentos)),
        
        total_gastos = IF(NEW.tipo_operacao = 'guardado', 
                        v_gastos, 
                        IF(NEW.categoria_id IS NOT NULL AND tipo_cat = 'gasto', 
                           v_gastos + NEW.amount, 
                           v_gastos)),
        
        metasAmount_ctl = IF(NEW.tipo_operacao = 'guardado', 
                           v_metas - NEW.amount, 
                           IF(NEW.tipo_operacao = 'resgatado', 
                              v_metas + NEW.amount, 
                              v_metas)),
        
        saldoAtual_amount = 
            v_inicial + 
            -- Recebimentos (normais + resgates)
            IF(NEW.categoria_id IS NOT NULL AND tipo_cat = 'recebimento', 
               v_recebimentos + NEW.amount, 
               v_recebimentos) -
            -- Gastos (normais + guardados)
            IF(NEW.categoria_id IS NOT NULL AND tipo_cat = 'gasto', 
               v_gastos + NEW.amount, 
               v_gastos) +
            -- Ajuste de metas (já refletido em metasAmount_ctl)
            IF(NEW.tipo_operacao = 'guardado', 
               v_metas - NEW.amount, 
               IF(NEW.tipo_operacao = 'resgatado', 
                  v_metas + NEW.amount, 
                  v_metas))
    WHERE userID = NEW.userID AND mes_id = NEW.mes_id;
END//

DELIMITER ;