<div class="p-5 border mt-5 mb-5">
    <div class="row">
        <div class="col">
            <h2>Mock Payment Gateway</h2>
            <p>This is a test payment gateway, you can either complete the payment or cancel the transaction.</p>
            <hr>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-6 pe-5">

        </div>

        
    </div>
</div>

<script>
    document.getElementById("productCategory").addEventListener("input", (event) => {
        console.log();
        if (event.target.value === "delivery")
            document.getElementById("address_form").classList.remove("d-none");

        if (event.target.value === "online")
            document.getElementById("address_form").classList.add("d-none");
    });
</script>