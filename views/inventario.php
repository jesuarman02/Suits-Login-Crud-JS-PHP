<body class="vh-100">
    
    <div class="row justify-content-center">
        <div class="col-8 p-5">
            <form action="inicio" method="post" class="p-4">
                <h2 class="text-center mb-4">Registrar Producto</h2>
                <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                    <span class="input-group-text"><i class="bi bi-box"></i></span>
                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre del producto" name="nombre_p" value="">
                </div>
                <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                    <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                    <input type="text" class="form-control" id="precio" placeholder="Ingrese el precio del producto" name="precio_p" value="">
                </div>
                <div class="input-group mt-3 c-input px-2 p-1 rounded-3">
                    <span class="input-group-text"><i class="bi bi-clipboard"></i></span>
                    <input type="text" class="form-control" id="cantidad" placeholder="Ingrese la cantidad del producto" name="cantidad_p" value="">
                </div>
                <div class="mt-3 d-flex justify-content-center">
                    <button type="button" id="btn-registrar-producto" class="btn btn-success fs-4 registrar_producto">Registrar producto</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12 p-5">
            <table id="myTable" class="display">
                <thead>
                    <tr style="background-color: #76c7c0; color: #2d3a4b;">
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tabla_productos">
                    <tr>

                    </tr>
                </tbody>
                </table>
        </div>
    </div>

</body>
<script src="./public/js/alerts.js"></script>
    <script src="./public/js/registro_productos.js"></script>
    <script src="./public/js/cerrar_session.js"></script>
    <script src="./public/js/main.js"></script>