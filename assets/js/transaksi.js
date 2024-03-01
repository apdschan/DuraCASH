function resetPage() {
    location.reload(); // Reload the page
}

// Add this code to your JavaScript file or in a <script> tag
document.addEventListener("DOMContentLoaded", function() {
    // Get the current date
    var currentDate = new Date();

    // Format the date as YYYY-MM-DD (which is the format expected by the input type="date")
    var formattedDate = currentDate.toISOString().split('T')[0];

    // Set the value of the transaction date input field to today's date
    document.getElementById('transactionDate').value = formattedDate;
});


// Add this code to your JavaScript file
function openCustModal() {
    var modal = document.getElementById('customerModal');
    modal.style.display = 'block';
}

function closeCustModal() {
    var modal = document.getElementById('customerModal');
    modal.style.display = 'none';
}
// Close the modal if the user clicks outside of it
window.onclick = function(event) {
    var modal = document.getElementById('customerModal');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
function addcustomer(namaPelanggan, pelangganID) {
    console.log("Nama Pelanggan:", namaPelanggan);
    console.log("ID Pelanggan:", pelangganID);

    document.getElementById('id').value = pelangganID;
    document.getElementById('idpelanggan').value = pelangganID;
    var customerInput = document.getElementById('pelanggan');
    if (customerInput) {
        customerInput.value = namaPelanggan;
    } else {
        console.error("Elemen dengan ID 'customer' tidak ditemukan.");
    }

    // Kirim pelangganID ke controller CodeIgniter dengan Ajax
    $.ajax({
         type: 'POST',
         url: 'http://localhost/durapos/kasir/kasir/tambahkeranjang',
         data: { pelangganID: pelangganID },
         success: function(response) {
             console.log("Data berhasil dikirim ke controller");
             // Handle response jika diperlukan
             //Close the customer modal
             closeCustModal();
         },
         error: function(error) {
             console.error("Gagal mengirim data ke controller:", error);
             // Handle error jika diperlukan
         }
     });
}

var selectedItems = [];

function checkAndOpenAddModal() {
    var customerInput = document.getElementById('pelanggan');
    var customerErrorMessage = document.getElementById('customerErrorMessage');

    // Periksa apakah input field pelanggan kosong
    if (customerInput.value.trim() === '') {
        // Jika kosong, tampilkan pesan error
        customerErrorMessage.style.display = 'block';
    } else {
        // Jika tidak kosong, sembunyikan pesan error dan lanjutkan ke modal tambah produk
        customerErrorMessage.style.display = 'none';
        openAddModal();
    }
}

function openAddModal() {
    var modal = document.getElementById('addItems');
    modal.style.display = 'block';
}

function closeAddModal() {
    var modal = document.getElementById('addItems');
    modal.style.display = 'none';
    updateAddedItemsList();
    updateAddedItemsListTransaksi();
}

// Close the modal if the user clicks outside of it
window.onclick = function (event) {
    var modal = document.getElementById('addItems');
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}

function AddItemsAct(produkID, pelangganID,transactionID) {
    // Buat objek data yang akan dikirim ke server
    console.log("InputValue:", pelangganID);

    var detailID = Math.floor(10000 + Math.random() * 90000);
    // Extract only the random number part
    var randomPart = transactionID.replace('POS-', '');
    
    // Display the extracted random number
    console.log("Random Number:", randomPart);

    var dataToSend = {
        detailID : detailID,
        produkID: produkID,
        pelangganID: pelangganID,
        transactionID: randomPart
        // tambahkan data lainnya jika diperlukan
    };

    // Kirim data menggunakan AJAX
    $.ajax({
        type: 'POST',
        url: 'http://localhost/durapos/kasir/kasir/tambahkeranjang', // Gantilah dengan controller dan metode yang sesuai
        data: dataToSend,
        success: function(response) {
            // Proses respons dari server jika diperlukan
            console.log("Data berhasil dikirim ke controller");
            openEditModal(detailID); 
        },
        error: function(error) {
            // Tangani kesalahan jika terjadi
            console.error("Gagal mengirim data ke controller:", error);
        }
    });
    
}

// Objek untuk menyimpan data produk
var productData = {};

function updateAddedItemsList() {
    var transactionNumber = document.getElementById('transactionNumber').value;
    // Hapus "POS-" dari transactionDate menggunakan metode replace
    transactionNumber = transactionNumber.replace('POS-', '');

    // Lakukan request AJAX untuk memperbarui tabel
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Jika request berhasil, Anda dapat melakukan sesuatu dengan responsnya
                // Misalnya, mengubah array JSON menjadi tabel HTML dan menyisipkannya ke dalam tabel yang telah Anda sediakan
                var data = JSON.parse(xhr.responseText);
                var tableBody = document.querySelector('#transactionData tbody');
                tableBody.innerHTML = renderTable(data);
            } else {
                // Jika request gagal, Anda bisa menangani kesalahan di sini
                console.error('Terjadi kesalahan dalam permintaan AJAX');
            }
        }
    };

    // Lakukan request ke URL yang sesuai untuk mendapatkan data tabel yang diperbarui
    xhr.open('GET', 'http://localhost/durapos/kasir/kasir/getdatabytransactionid?transaction_number=' + transactionNumber, true);
    xhr.send();
}

function updateAddedItemsListTransaksi() {
    var transactionNumber = document.getElementById('transactionNumber').value;
    // Hapus "POS-" dari transactionDate menggunakan metode replace
    transactionNumber = transactionNumber.replace('POS-', '');

    // Lakukan request AJAX untuk memperbarui tabel
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Jika request berhasil, Anda dapat melakukan sesuatu dengan responsnya
                // Misalnya, mengubah array JSON menjadi tabel HTML dan menyisipkannya ke dalam tabel yang telah Anda sediakan
                var data = JSON.parse(xhr.responseText);
                var tableBody = document.querySelector('#transactionData2 tbody');
                tableBody.innerHTML = renderTableTransaksi(data);
            } else {
                // Jika request gagal, Anda bisa menangani kesalahan di sini
                console.error('Terjadi kesalahan dalam permintaan AJAX');
            }
        }
    };

    // Lakukan request ke URL yang sesuai untuk mendapatkan data tabel yang diperbarui
    xhr.open('GET', 'http://localhost/durapos/kasir/kasir/getdatabytransactionid?transaction_number=' + transactionNumber, true);
    xhr.send();
}

// Fungsi untuk mengubah array JSON menjadi elemen tabel HTML
function renderTable(data) {
    var html = '';
    data.forEach(function(row) {
        html += '<tr>';
        html += '<td>' + productData[row.ProdukID].nama + '</td>'; // Menggunakan data produk lokal untuk mendapatkan nama produk
        html += '<td>' + row.JumlahProduk + '</td>';
        html += '<td>' + row.Subtotal + '</td>';
        html += ' <td class="action-buttons"> <a href="#" class="btn-edit" onclick="openEditModal(' + row.DetailID + ')"><i class="ion-edit"></i></a><a href="#" class="btn-delete" onclick="openDeleteModal(' + row.DetailID + ')"> <i class="ion-android-delete"></i></a></td>'
        html += '</tr>';
    });
    return html;
}

// Fungsi untuk mengubah array JSON menjadi elemen tabel HTML
function renderTableTransaksi(data) {
    var html = '';
    var grandTotal = 0;
    data.forEach(function(row) {
        html += '<tr>';
        html += '<td>' + productData[row.ProdukID].nama + '</td>'; // Menggunakan data produk lokal untuk mendapatkan nama produk
        html += '<td>' + row.JumlahProduk + '</td>';
        html += '<td>' + productData[row.ProdukID].hargaJual + '</td>'; // Menggunakan data produk lokal untuk mendapatkan harga jual
                
        // Calculating and displaying the total purchase cost (quantity * buying price)
        var totalPurchaseCost = row.JumlahProduk * productData[row.ProdukID].hargaBeli;
        
        html += '<td>' + row.Subtotal + '</td>';
        html += '</tr>';
        
        // Tambahkan subtotal dari setiap baris ke grand total
        grandTotal += parseFloat(row.Subtotal);
        
        document.getElementById('pengeluaran').value = totalPurchaseCost; // Set nilai input hidden
    });

    // Ambil nilai grandTotal di sini, setelah loop forEach selesai
    grandTotalSub = grandTotal.toFixed(2); // Ubah menjadi string dengan dua angka di belakang koma
    document.getElementById('grandtotal').value = grandTotalSub; // Set nilai input hidden

    // Tambahkan grand total ke dalam tabel setelah loop forEach selesai
    html += '<tr>';
    html += '<td colspan="3" align="right"><strong>Grand Total:</strong></td>';
    html += '<td>' + grandTotal.toFixed(2) + '</td>';
    html += '</tr>';
    
    return html;
}

// Lakukan request AJAX untuk mendapatkan data produk dari database saat halaman dimuat
window.onload = function() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Jika request berhasil, simpan data produk ke dalam objek productData
                var products = JSON.parse(xhr.responseText);
                products.forEach(function(product) {
                    productData[product.ProdukID] = {
                        nama: product.NamaProduk,
                        hargaJual: product.HargaJual,
                        hargaBeli: product.HargaBeli,
                    };
                });
            } else {
                // Jika request gagal, Anda bisa menangani kesalahan di sini
                console.error('Terjadi kesalahan dalam permintaan AJAX');
            }
        }
    };

    // Lakukan request ke URL yang sesuai untuk mendapatkan data produk dari database
    xhr.open('GET', 'http://localhost/durapos/kasir/kasir/list_produk_js', true);
    xhr.send();
};

document.addEventListener('DOMContentLoaded', function() {
    // Get current date components// Generate random number with at least 5 digits
    var randomPart = Math.floor(10000 + Math.random() * 90000);

    // Set the value of the input field
    document.getElementById('transactionNumber').value = 'POS-' + randomPart;
});

function openEditModal(detailID) {
    console.log("Buka modal untuk Penjualan ID:", detailID);
    
    $.ajax({
        type: 'POST', // or 'POST' depending on your needs
        url: 'http://localhost/durapos/kasir/kasir/editmodalkeranjang/' + detailID, // Corrected using produkid
        data: {
            detailID: detailID,
        },
        success: function(response) {
            $("#editModal").html(response).css("display", "flex");
            //document.getElementById("editModal").style.display = "flex";
            //$("#editModal").html(response).modal('show');
            // $(response).modal("show");
            // $('body').removeClass('modal-backdrop');
            // $('.modal-backdrop').remove();
        },
        error: function(xhr, status, error) {
            // Handle error if needed
        }
    });
}

// Function to close the edit pop-up
function closeEditModal() {
    document.getElementById("editModal").style.display = "none";
}

// Function to close the delete confirmation pop-up
function closeDeleteModal() {
    document.getElementById("deleteConfirmModal").style.display = "none";
}

var currentPage = 1;
var rowsPerPage = 5; // Number of rows per page, adjust as needed
function showRowsForPage(page) {
    var table = document.getElementById("tabelProduk");
    var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) { // Start from 1 to exclude the header row
        rows[i].style.display = (i >= (page - 1) * rowsPerPage + 1 && i <= page * rowsPerPage) ? "" : "none";
    }
    // Show or hide pagination buttons based on current page
    document.getElementById("previousButton").disabled = (currentPage > 1) ? false : true;
    document.getElementById("nextButton").disabled = (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) ? false : true;
}
function searchItem() {
    var input = document.getElementById("searchInput").value.toUpperCase();
    var table = document.getElementById("tabelProduk");
    var rows = table.getElementsByTagName("tr");
    for (var i = 1; i < rows.length; i++) { // Start from 1 to exclude the header row
        var rowData = rows[i].innerText.toUpperCase();
        if (rowData.indexOf(input) > -1) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
    // Reset current page after search
    currentPage = 1;
    document.getElementById("currentPage").innerText = currentPage;
    // Disable buttons after search
    document.getElementById("previousButton").disabled = true;
    document.getElementById("nextButton").disabled = (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) ? false : true;
}
function previousPage() {
    if (currentPage > 1) {
        currentPage--;
        document.getElementById("currentPage").innerText = currentPage;
        showRowsForPage(currentPage);
    }
}
function nextPage() {
    var table = document.getElementById("tabelProduk");
    var rows = table.getElementsByTagName("tr");
    if (currentPage < Math.ceil((rows.length - 1) / rowsPerPage)) {
        currentPage++;
        document.getElementById("currentPage").innerText = currentPage;
        showRowsForPage(currentPage);
    }
}
// Show initial page
showRowsForPage(currentPage);

function handlePayButtonClick() {
    var customerInput = document.getElementById('pelanggan');
    var customerErrorMessage = document.getElementById('customerErrorMessage');

    // Periksa apakah input field pelanggan kosong
    if (customerInput.value.trim() === '') {
        // Jika kosong, tampilkan pesan error
        customerErrorMessage.style.display = 'block';
    } else {
        // Jika tidak kosong, sembunyikan pesan error dan lanjutkan ke modal tambah produk
        customerErrorMessage.style.display = 'none';
        openPayModal();
    }
}

// Function to open the payment confirmation modal
function openPayModal() {
    var modal = document.getElementById('payModal');
    modal.style.display = 'block';
    populatePaymentDetails(); // Call function to populate payment details
}

// Function to close the payment confirmation modal
function cancelPayment() {
    var modal = document.getElementById('payModal');
    modal.style.display = 'none';
}

// Function to populate payment details in the table
function populatePaymentDetails() {
    // Mendapatkan nilai input pertama
    var inputValue = document.getElementById('transactionNumber').value;
    
    // Mengatur nilai input kedua
    document.getElementById('transactionNumber2').value = inputValue;
    // Mendapatkan nilai input pertama
    var inputValue = document.getElementById('transactionDate').value;
    
    // Mengatur nilai input kedua
    document.getElementById('transactionDate2').value = inputValue;
    // Mendapatkan nilai input pertama
    var inputValue = document.getElementById('idpelanggan').value;
    
    // Mengatur nilai input kedua
    document.getElementById('idpelanggan2').value = inputValue;
    // Mendapatkan nilai input pertama
    var inputValue = document.getElementById('pelanggan').value;
    
    // Mengatur nilai input kedua
    document.getElementById('pelanggan2').value = inputValue;

    var tableRows = document.querySelectorAll('.table tbody tr');
    var tableBody = document.getElementById('paymentDetails');

    // Clear existing rows
    tableBody.innerHTML = '';

    // Loop through the table rows
    tableRows.forEach(function(row) {
        var name = row.cells[0].textContent;
        var qty = row.cells[1].textContent;
        var sell = row.cells[2].textContent;
        var total = row.cells[3].textContent;

        var newRow = document.createElement('tr');

        var nameCell = document.createElement('td');
        nameCell.textContent = name;
        newRow.appendChild(nameCell);

        var qtyCell = document.createElement('td');
        qtyCell.textContent = qty;
        newRow.appendChild(qtyCell);

        var sellCell = document.createElement('td');
        sellCell.textContent = sell;
        newRow.appendChild(sellCell);

        var totalCell = document.createElement('td');
        totalCell.textContent = total;
        newRow.appendChild(totalCell);

        tableBody.appendChild(newRow);
    });
}



// Function to confirm payment
function confirmPayment() {
    // Add your logic here to confirm the payment
    // For now, let's just close the payment modal and open the print modal
    cancelPayment();
    
    // Get customer name, transaction date, and transaction number
    var customerName = document.getElementById('pelanggan').value;
    var transactionDate = document.getElementById('transactionDate').value;
    var transactionNumber = document.getElementById('transactionNumber').value;

    // Update the PrintPayModal with customer name, transaction date, and transaction number
    document.getElementById('customerNamePrint').textContent = 'Customer Name: ' + customerName;
    document.getElementById('transactionDatePrint').textContent = 'Transaction Date: ' + transactionDate;
    document.getElementById('transactionNumberPrint').textContent = 'Transaction Number: ' + transactionNumber;

    // Open the print modal
    openPrintModal();
    printConfirmationModal();
}


// Function to open the print modal
function openPrintModal() {
    var modal = document.getElementById('PrintPayModal');
    modal.style.display = 'block';
}

// Function to print the payment confirmation modal
function printConfirmationModal() {
    window.print();
    closePrintModal();

}

// Function to close the PrintPayModal
function closePrintModal() {
    var modal = document.getElementById('PrintPayModal');
    modal.style.display = 'none';
}

document.getElementById("dateNow").innerHTML = Date();