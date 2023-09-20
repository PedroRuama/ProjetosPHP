var inputV = document.getElementsById('id')
var labelPosition = document.getElementsById('id_label')

if (inputV != null) {
    labelPosition.style.removeProperty("font-size")
    labelPosition.style.removeProperty("translate")
    labelPosition.style = "padding-inline: 5px; translate: 10px -10px; scale: 0.8; background-color: whitesmoke;"
}