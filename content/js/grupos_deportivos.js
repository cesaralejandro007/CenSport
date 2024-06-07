function Limitar(event, cantidad) {
    if (event.value.length >= cantidad) {
        event.value = event.value.substring(0, cantidad);
    }
}