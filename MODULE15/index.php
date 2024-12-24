<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Product Management Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .actions button {
            margin-right: 5px;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
        }
        .actions .edit {
            background-color: #4CAF50;
            color: white;
        }
        .actions .delete {
            background-color: #f44336;
            color: white;
        }
        .add-product {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .add-product button {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Product Management Dashboard</h1>
        <div class="add-product">
            <h2>Product List</h2>
            <button onclick="showAddProductForm()">Add New Product</button>
        </div>
        <table id="productTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div id="productForm" style="display:none;">
        <h2 id="formTitle">Add New Product</h2>
        <form onsubmit="submitForm(event)">
            <label for="productId">ID:</label>
            <input type="text" id="productId" disabled><br><br>

            <label for="productTitle">Title:</label>
            <input type="text" id="productTitle" required><br><br>

            <label for="productDescription">Description:</label><br>
            <textarea id="productDescription" required></textarea><br><br>

            <label for="productQuantity">Quantity:</label>
            <input type="number" id="productQuantity" required><br><br>

            <label for="productPrice">Price:</label>
            <input type="number" step="0.01" id="productPrice" required><br><br>

            <button type="submit">Save</button>
            <button type="button" onclick="closeForm()">Cancel</button>
        </form>
    </div>

    <script>
        const products = [
            { id: 1, title: "Product 1", description: "Description 1", quantity: 10, price: 100.00 },
            { id: 2, title: "Product 2", description: "Description 2", quantity: 20, price: 200.00 }
        ];

        function renderProducts() {
            const tableBody = document.querySelector("#productTable tbody");
            tableBody.innerHTML = "";
            products.forEach(product => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${product.id}</td>
                    <td>${product.title}</td>
                    <td>${product.description}</td>
                    <td>${product.quantity}</td>
                    <td>${product.price.toFixed(2)}</td>
                    <td class="actions">
                        <button class="edit" onclick="editProduct(${product.id})">Edit</button>
                        <button class="delete" onclick="deleteProduct(${product.id})">Delete</button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        function showAddProductForm() {
            document.getElementById("productForm").style.display = "block";
            document.getElementById("formTitle").innerText = "Add New Product";
            clearForm();
        }

        function editProduct(id) {
            const product = products.find(p => p.id === id);
            if (!product) return;

            document.getElementById("productForm").style.display = "block";
            document.getElementById("formTitle").innerText = "Edit Product";

            document.getElementById("productId").value = product.id;
            document.getElementById("productTitle").value = product.title;
            document.getElementById("productDescription").value = product.description;
            document.getElementById("productQuantity").value = product.quantity;
            document.getElementById("productPrice").value = product.price;
        }

        function deleteProduct(id) {
            const index = products.findIndex(p => p.id === id);
            if (index !== -1) {
                products.splice(index, 1);
                renderProducts();
            }
        }

        function submitForm(event) {
            event.preventDefault();

            const id = document.getElementById("productId").value;
            const title = document.getElementById("productTitle").value;
            const description = document.getElementById("productDescription").value;
            const quantity = parseInt(document.getElementById("productQuantity").value, 10);
            const price = parseFloat(document.getElementById("productPrice").value);

            if (id) {
                // to edit product
                const product = products.find(p => p.id == id);
                if (product) {
                    product.title = title;
                    product.description = description;
                    product.quantity = quantity;
                    product.price = price;
                }
            } else {
                // to add new product
                const newProduct = {
                    id: products.length ? products[products.length - 1].id + 1 : 1,
                    title,
                    description,
                    quantity,
                    price
                };
                products.push(newProduct);
            }

            closeForm();
            renderProducts();
        }

        function clearForm() {
            document.getElementById("productId").value = "";
            document.getElementById("productTitle").value = "";
            document.getElementById("productDescription").value = "";
            document.getElementById("productQuantity").value = "";
            document.getElementById("productPrice").value = "";
        }

        function closeForm() {
            document.getElementById("productForm").style.display = "none";
            clearForm();
        }

        renderProducts();
    </script>
</body>
</html>
