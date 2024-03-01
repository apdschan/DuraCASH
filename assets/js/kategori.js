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
    var itemName = document.getElementById("itemName").value;
    var itemDesc = document.getElementById("itemDesc").value;

    // Add your logic here to handle the form submission and add a new category
    // You may want to use AJAX to send the form data to the server
    // After adding, close the modal
    closeAddModal();
}

// Function to open the View Modal
function openViewModal(item) {
    var itemName = item.parentNode.parentNode.cells[0].innerText;
    var itemDesc = item.parentNode.parentNode.cells[1].innerText;

    var viewContent = document.getElementById("viewContent");
    viewContent.innerHTML = `
        <p><strong>Nama:</strong> ${itemName}</p>
        <p><strong>Deskripsi:</strong> ${itemDesc}</p>
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
    document.getElementById("editModalKategori").style.display = "none";
}

// Function to close the Delete Modal
function closeDeleteModal() {
    document.getElementById("deleteModal").style.display = "none";
}
