-- Productos del catálogo Winbeaut con imágenes
USE winbeaut_db;

-- Insertar productos del catálogo
INSERT INTO productos (nombre, descripcion, precio, imagen, categoria, stock) VALUES
-- Labiales
('Lip liner Italia deluxe', 'Lápiz delineador de labios Italia deluxe. Tonos: 1002 Dark brown, 1009 Medium brown, 1033 Natural, 1053 Rich red, 1057 Black currant, 1061 Mahogany', 25.00, 'lip-liner-italia.jpg', 'Labiales', 50),
('Mousse matte lipstick', 'Labial mousse con acabado mate. Tonos: 03 Marilyn, 06 Terracota, 07 Barely nude, 11 Pink charm, 16 Saint, 20 Gypsy, 21 Black cherry, 23 Sweet chocolate, 24 Hazelnut, 25 Maroon, 26 Brownie, 27 Sangria, 29 Fudge pop, 36 Osito, 37 Spice', 60.00, 'mousse-matte.jpg', 'Labiales', 100),
('Lip oil con ácido hialurónico', 'Aceite para labios con ácido hialurónico que cambia de color con el PH. Sabor: Coco natural (No cambia de color)', 114.00, 'lip-oil-hialuronico.jpg', 'Labiales', 75),
('Lip oil sabores', 'Aceite para labios con deliciosos sabores. Tonos: 01 vainilla, 03 frutos del bosque, 05 Frambuesa, 06 chabacano, 07 frutas de la pasión', 87.00, 'lip-oil-sabores.jpg', 'Labiales', 80),
('Tinted lip oil', 'Aceite para labios con color', 147.00, 'tinted-lip-oil.jpg', 'Labiales', 60),
('Lip gloss con brillo', 'Brillo hidratante de efecto húmedo con glitter para labios. Tono: Fairy dust, Shine', 114.00, 'lip-gloss-brillo.jpg', 'Labiales', 90),
('Lip liner delineador', 'Lápiz delineador de labios de textura suave y de larga duración. Tono: PKLL31, PKLL30', 37.00, 'lip-liner.jpg', 'Labiales', 100),
('Lipstick cremoso', 'Labial de textura cremosa y acabado mate de larga duración. Tono: Toast, Petal, Luxe, Brunette, Flame', 88.00, 'lipstick-cremoso.jpg', 'Labiales', 85),
('Lip gloss efecto botox', 'Brillo labial con efecto de volumen. Tono: Cute, Blossom', 114.00, 'lip-gloss-botox.jpg', 'Labiales', 70),
('Lip treatment', 'Tratamiento para labios. Tono: One in a melon, Coco dream', 200.00, 'lip-treatment.jpg', 'Labiales', 40),
('Plumping gloss stick', 'Brillo en barra con efecto voluminizador. Tono: Love trap', 154.00, 'plumping-gloss.jpg', 'Labiales', 55),
('Wooden lip pencil', 'Lápiz de labios de madera. Tono: Cocoa me, Nice & toasty, La vida mocha, Butta u up', 65.00, 'wooden-pencil.jpg', 'Labiales', 95),
('Brillo labial con glitter', 'Brillo para labios. Tono: Reluciente, Luminosa, Radiante, Incandescente. Con glitter - Tono: Orión', 65.00, 'brillo-glitter.jpg', 'Labiales', 100),
('Mousse Matte', 'Labial mousse mate. Tono: 01 Almond, 02 Cocoa, 04 Lethal, 05 Naked, 09 Spanish rose, 10 Sweetie', 80.00, 'mousse-matte-2.jpg', 'Labiales', 75),
('Brillo labial mágico', 'Brillo que cambia de color. Sabor: Uva, Naranja', 76.00, 'brillo-magico.jpg', 'Labiales', 80),
('Labial humectante', 'Labial con propiedades humectantes. Tono: Lightstick, Idol, 02 Mocorito, 04 Comala, 05 Mazunte, 06 Tepoztlán, 07 Malinalco, 16 Cosalá', 55.00, 'labial-humectante.jpg', 'Labiales', 90),
('Delineador de labios', 'Lápiz delineador. Tono: 01 Frambuesa, 02 Rojo quemado, 03 Vino, 05 Natural', 72.00, 'delineador-labios.jpg', 'Labiales', 100),
('Tinta de labios', 'Tinta líquida para labios. Tono: 08 Marruecos', 84.00, 'tinta-labios.jpg', 'Labiales', 70),
('Kiss lip tint', 'Tinta para labios indeleble. Tono: Cute, Blossom', 108.00, 'kiss-tint.jpg', 'Labiales', 65),

-- Rostro
('Gel de ceja transparente', 'Gel fijador para cejas. Tono: Transparente', 90.00, 'gel-ceja.jpg', 'Cejas', 100),
('Maquillaje compacto para rostro', 'Base compacta para rostro. Tono: 04 Sand, 05 Pebble, 10 Honey', 119.00, 'maquillaje-compacto.jpg', 'Rostro', 80),
('Primer iluminador', 'Primer iluminador para rostro. Tono: Solar', 127.00, 'primer-iluminador.jpg', 'Rostro', 70),
('Rubor líquido', 'Liquid blush de larga duración fórmula líquida multiusos. Tono: Sunrise (con brillo), Mauve, Sunset, Dream', 153.00, 'rubor-liquido.jpg', 'Rubor', 85),
('Minimizador de poros', 'Bye, bye pores con efecto aterciopelado matifica. Tonos: Headliner, Lucky lucky, No shade', 127.00, 'minimizador-poros.jpg', 'Rostro', 75),
('BB cream', 'Crema hidratante con color acabado mate. Tono: Matte light, Matte medium, Matte tan', 166.00, 'bb-cream.jpg', 'Rostro', 60),
('Face primer', 'Primer para rostro con ácido hialurónico cero brillo con acabado mate', 166.00, 'face-primer.jpg', 'Rostro', 70),
('Luminous powder', 'Iluminador en polvo compacto. Tono: Glow, Flash', 153.00, 'luminous-powder.jpg', 'Rostro', 80),
('Liquid concealer', 'Corrector líquido concentrado de alta pigmentación con acabado mate y larga duración. Tono: 100 pale, 101 fair, 102 porcelain, 200 beige, 202 soft beige, 300 Medium, 801 soft pink', 124.00, 'liquid-concealer.jpg', 'Rostro', 90),
('Paleta para rostro', 'Paleta multiusos. Tonos: 01 La mera mera', 138.00, 'paleta-rostro.jpg', 'Rostro', 50),
('Rubor líquido', 'Rubor en presentación líquida. Tono: 04 Pinky promise, 06 Comadre, 08 Netas', 92.00, 'rubor-liquido-2.jpg', 'Rubor', 85),
('Rubor en polvo', 'Rubor compacto. Tono: 07 Terracota, 08 Chedron, 10 Frambuesa, 20 Coral', 56.00, 'rubor-polvo.jpg', 'Rubor', 100),
('Gripping primer', 'Primer de agarre para maquillaje', 135.00, 'gripping-primer.jpg', 'Rostro', 65),
('Contorno en barra Beauty Creations', 'Contorno en barra. Tono: Espresso', 200.00, 'contorno-barra.jpg', 'Rostro', 55),
('Perfilador para rostro', 'Perfilador facial', 54.00, 'perfilador-rostro.jpg', 'Rostro', 90),

-- Ojos
('Eyeliner ultra fine', 'Plumón delineador de precisión y larga duración', 166.00, 'eyeliner.jpg', 'Ojos', 80),
('Rimel Volume xtreme', 'Volumen, curvatura, alargamiento, negro intenso y a prueba de agua', 153.00, 'rimel-volume.jpg', 'Ojos', 75),
('Rimel Ultra lashes', 'Define, volumen, alarga, color intenso y a prueba de agua', 153.00, 'rimel-ultra.jpg', 'Ojos', 75),
('Lash curler', 'Rizador de pestañas', 80.00, 'lash-curler.jpg', 'Ojos', 60),
('Lápiz de ceja retráctil', 'Lápiz para cejas. Tono: 02 Brown, 03 Brown black, 04 Brownish, 05 Coffee', 90.00, 'lapiz-ceja.jpg', 'Cejas', 95),
('Brocha para ceja', 'Brocha especializada para cejas', 76.00, 'brocha-ceja.jpg', 'Brochas', 70),
('Gel fijador de ceja', 'Gel transparente para fijar cejas. Tono: Transparente', 24.00, 'gel-fijador.jpg', 'Cejas', 100),
('Rimel mirada seductora', 'Máscara de pestañas', 43.00, 'rimel-seductora.jpg', 'Ojos', 85),
('Mascara de pestañas', 'Rímel para pestañas', 40.00, 'mascara-pestanas.jpg', 'Ojos', 90),

-- Accesorios
('Set de 3 borlas Puff puff', 'Set de 3 borlas para polvo - the perfect trio', 210.00, 'puff-trio.jpg', 'Accesorios', 45),
('Esponja de maquillaje Bissú - Gota', 'Esponja tipo gota marca Bissú', 52.00, 'esponja-gota.jpg', 'Accesorios', 100),
('Esponja de maquillaje Bissú - Gema', 'Esponja tipo gema marca Bissú', 52.00, 'esponja-gema.jpg', 'Accesorios', 100),
('Sacapuntas', 'Sacapuntas para lápices de maquillaje', 10.00, 'sacapuntas.jpg', 'Accesorios', 150),
('Pinza para el cabello', 'Diseño flor de verano', 30.00, 'pinza-cabello.jpg', 'Accesorios', 80),
('Borla triangular', 'Borla para maquillaje forma triangular', 68.00, 'borla-triangular.jpg', 'Accesorios', 75),
('Borla redonda mediana', 'Borla redonda tamaño mediano', 63.00, 'borla-mediana.jpg', 'Accesorios', 80),
('Borla redonda mini', 'Borla redonda tamaño mini', 51.00, 'borla-mini.jpg', 'Accesorios', 85),
('Fijador de maquillaje', 'Spray fijador para maquillaje', 145.00, 'fijador-maquillaje.jpg', 'Accesorios', 60),

-- Productos Premium
('Juicy fizz Kiko Milano', 'Color shot lip gloss & stain. Tono: 01', 465.00, 'kiko-milano.jpg', 'Labiales Premium', 25),
('Tinta Elf labios y mejillas', 'Tinta multiusos. Tono: Pink positive, Plums up', 264.00, 'elf-tinta.jpg', 'Labiales Premium', 35),
('Rubor en barra Beauty Creations', 'Rubor cremoso en barra. Tono: Fucsia thoughts, Mauve please, Pink energy', 200.00, 'bc-rubor.jpg', 'Rubor Premium', 40),
('Butter bliss lip balm Moira', 'Bálsamo labial. Tono: 007 Pout perfection, 008 Summer bliss, 009 Everything nice', 178.00, 'moira-balm.jpg', 'Labiales Premium', 45),
('Labial líquido matte', 'Labial líquido acabado mate. Tono: Mud, Deep red', 70.00, 'labial-matte.jpg', 'Labiales', 80),
('Jelly tint', 'Tinta gelatinosa. Tono: 01 Pink punch, 02 Cherry me, 03 Just peachy, 04 Cherry bomb', 78.00, 'jelly-tint.jpg', 'Labiales', 75),
('Tinta de labios Dapop', 'Tinta líquida. Tono: 04 Papillon', 55.00, 'dapop-tinta.jpg', 'Labiales', 70),
('Gloss con brillo Dapop', 'Brillo labial. Tono: Pretty rich, Daily deals', 55.00, 'dapop-gloss.jpg', 'Labiales', 75),
('Lip gloss Dapop', 'Brillo para labios. Tono: 1 Mocha, 4 Cherry, 6 Merlot', 52.00, 'dapop-lipgloss.jpg', 'Labiales', 80);
