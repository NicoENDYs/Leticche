<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FastFood - Tu Comida Rápida Favorita</title>
    <link rel="stylesheet" href="../styles/ecommerce.css">
    <script defer src="../js/ecommerce.js"></script>
</head>
<body>
    <!-- Header con navegación -->
    <header class="header">
        <nav class="navbar">
            <a href="#" class="logo">Letti<span>che</span></a>
            <div class="nav-links">
                <a href="#" class="nav-item">
                    <span class="nav-item-text">Iniciar Sesión</span>
                </a>
                <a href="#" class="nav-item">
                    <span class="nav-item-text">Crear Cuenta</span>
                </a>
                <a href="#" class="nav-item cart-icon">
                    🛒
                    <span class="cart-count">3</span>
                </a>
            </div>
        </nav>
    </header>

    <div class="container">
        <!-- Categoría: Hamburguesas -->
        <section class="category-section">
            <h2 class="category-title">Hamburguesas</h2>
            <div class="products-row">
                <!-- Producto 1 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Hamburguesa Clásica">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Hamburguesa Clásica</h3>
                        <p class="product-description">Deliciosa hamburguesa con carne de res, queso cheddar, lechuga, tomate y nuestra salsa especial.</p>
                        <div class="product-price">
                            <span class="current-price">$8.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(45)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Hamburguesa Doble Queso">
                        <div class="discount-badge">-15%</div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Hamburguesa Doble Queso</h3>
                        <p class="product-description">Doble carne, triple queso, bacon crujiente y salsa BBQ casera.</p>
                        <div class="product-price">
                            <span class="current-price">$10.99</span>
                            <span class="original-price">$12.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★★</div>
                                <span class="rating-count">(87)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 3 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Hamburguesa Vegetariana">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Hamburguesa Vegetariana</h3>
                        <p class="product-description">Hamburguesa de garbanzos y verduras con aguacate, rúcula y alioli de ajo.</p>
                        <div class="product-price">
                            <span class="current-price">$9.49</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(32)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 4 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Hamburguesa BBQ">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Hamburguesa BBQ</h3>
                        <p class="product-description">Con aros de cebolla, salsa BBQ, queso fundido y carne ahumada.</p>
                        <div class="product-price">
                            <span class="current-price">$11.49</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(64)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Categoría: Pizzas -->
        <section class="category-section">
            <h2 class="category-title">Pizzas</h2>
            <div class="products-row">
                <!-- Producto 1 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Pizza Margarita">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Pizza Margarita</h3>
                        <p class="product-description">La clásica con salsa de tomate, mozzarella fresca y albahaca.</p>
                        <div class="product-price">
                            <span class="current-price">$12.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★★</div>
                                <span class="rating-count">(56)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Pizza Pepperoni">
                        <div class="discount-badge">-20%</div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Pizza Pepperoni</h3>
                        <p class="product-description">Pepperoni italiano, queso mozzarella y orégano sobre nuestra salsa casera.</p>
                        <div class="product-price">
                            <span class="current-price">$11.99</span>
                            <span class="original-price">$14.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(78)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 3 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Pizza 4 Quesos">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Pizza 4 Quesos</h3>
                        <p class="product-description">Combinación de mozzarella, gorgonzola, parmesano y queso de cabra.</p>
                        <div class="product-price">
                            <span class="current-price">$13.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(42)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 4 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Pizza Hawaiana">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Pizza Hawaiana</h3>
                        <p class="product-description">Con jamón, piña, extra de queso mozzarella y salsa de tomate.</p>
                        <div class="product-price">
                            <span class="current-price">$12.49</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★☆☆</div>
                                <span class="rating-count">(38)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Categoría: Complementos -->
        <section class="category-section">
            <h2 class="category-title">Complementos</h2>
            <div class="products-row">
                <!-- Producto 1 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Patatas Fritas">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Patatas Fritas</h3>
                        <p class="product-description">Crujientes por fuera, suaves por dentro. Con sal marina.</p>
                        <div class="product-price">
                            <span class="current-price">$3.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(95)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Nuggets de Pollo">
                        <div class="discount-badge">-10%</div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Nuggets de Pollo</h3>
                        <p class="product-description">8 piezas de nuggets de pollo con salsa a elegir.</p>
                        <div class="product-price">
                            <span class="current-price">$5.99</span>
                            <span class="original-price">$6.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(62)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 3 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Aros de Cebolla">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Aros de Cebolla</h3>
                        <p class="product-description">Aros de cebolla rebozados y fritos. Servidos con salsa ranch.</p>
                        <div class="product-price">
                            <span class="current-price">$4.49</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(54)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 4 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Ensalada César">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Ensalada César</h3>
                        <p class="product-description">Lechuga romana, crutones, pollo, queso parmesano y aderezo César.</p>
                        <div class="product-price">
                            <span class="current-price">$7.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(35)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Categoría: Bebidas -->
        <section class="category-section">
            <h2 class="category-title">Bebidas</h2>
            <div class="products-row">
                <!-- Producto 1 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Refresco Cola">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Refresco Cola</h3>
                        <p class="product-description">Refresco de cola con hielo. 500ml.</p>
                        <div class="product-price">
                            <span class="current-price">$2.49</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(85)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 2 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Batido de Chocolate">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Batido de Chocolate</h3>
                        <p class="product-description">Batido cremoso de chocolate con nata montada y sirope.</p>
                        <div class="product-price">
                            <span class="current-price">$4.99</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★★</div>
                                <span class="rating-count">(74)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 3 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Agua Mineral">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Agua Mineral</h3>
                        <p class="product-description">Botella de agua mineral 500ml.</p>
                        <div class="product-price">
                            <span class="current-price">$1.49</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(48)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
                
                <!-- Producto 4 -->
                <div class="product-card">
                    <div class="product-image">
                        <img src="/api/placeholder/300/200" alt="Cerveza">
                        <div class="discount-badge">-15%</div>
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">Cerveza</h3>
                        <p class="product-description">Cerveza rubia 330ml. Solo para mayores de edad.</p>
                        <div class="product-price">
                            <span class="current-price">$3.49</span>
                            <span class="original-price">$4.19</span>
                        </div>
                        <div class="product-footer">
                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="rating-count">(56)</span>
                            </div>
                            <button class="add-to-cart">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>