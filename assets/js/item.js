// Function to open the Add Customer modal
function openAddModal() {
    document.getElementById('addModal').style.display = 'flex';
}

// Function to close the Add Customer modal
function closeAddModal() {
    document.getElementById('addModal').style.display = 'none';
}

// Function to confirm the addition of a customer (you can customize this based on your needs)
function confirmAdd() {
    // Add your logic here to handle the form submission and add a new customer
    // You may want to use AJAX to send the form data to the server
    // After adding, close the modal
    closeAddModal();
}

// Function to open the View Modal
function openViewModal(item) {
    var itemName = item.parentNode.parentNode.cells[0].innerText;
    var itemCategory = item.parentNode.parentNode.cells[1].innerText;
    var itemStock = item.parentNode.parentNode.cells[2].innerText;
    var itemBuyPrice = item.parentNode.parentNode.cells[3].innerText;
    var itemSellPrice = item.parentNode.parentNode.cells[6].innerText;

    var viewContent = document.getElementById("viewContent");
    viewContent.innerHTML = `
        <p><strong>Nama:</strong> ${itemName}</p>
        <p><strong>Kategori:</strong> ${itemCategory}</p>
        <p><strong>Stok:</strong> ${itemStock}</p>
        <p><strong>Harga Beli:</strong> ${itemBuyPrice}</p>
        <p><strong>Harga Jual (setelah diberi diskon):</strong> ${itemSellPrice}</p>
    `;

    document.getElementById("viewModal").style.display = "flex";
}

// Function to close the View Modal
function closeViewModal() {
    document.getElementById("viewModal").style.display = "none";
}

// Function to confirm the Edit action
function confirmEdit() {
    // Add your logic here to handle the edit action
    $("#formedit").submit();
    closeEditModal();
}

// Function to close the Edit Modal
function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

// Function to close the Delete Modal
function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}
