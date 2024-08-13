document.addEventListener("DOMContentLoaded", () => {
    const vehiclePriceInput = document.getElementById("vehiclePrice");
    const customsTaxInput = document.getElementById("customsTax");
    const vatInput = document.getElementById("vat");
    const totalInput = document.getElementById("total");
    const exchangeRate = document.getElementById("exchangeRate");

    vehiclePriceInput.addEventListener("keydown", (event) => {
        if(["e", "E", "+", "-"].includes(event.key))
            event.preventDefault();
    })

    vehiclePriceInput.addEventListener("input", () => {
        const vehiclePrice = parseFloat(vehiclePriceInput.value) * parseFloat(exchangeRate.value);
        const customsTax = Math.ceil(10 * vehiclePrice / 100);
        const vat = Math.ceil(20 * (customsTax + vehiclePrice) / 100);

        customsTaxInput.value = customsTax
        vatInput.value = vat
        totalInput.value = customsTax + vat
    })
})
