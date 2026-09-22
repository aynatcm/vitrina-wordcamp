# Vitrina WordCamp

Theme demostrativo para charla **“No todo lo que vende necesita WooCommerce”**.

## Incluye

- Landing responsive.
- CPT nativo `producto`.
- Tres campos ACF: precio, descripción corta y enlace de contacto.
- Templates de portada, producto individual y archivo.
- Requiere ACF gratuito. No usa WooCommerce.

## Uso

1. Instalar y activar **Advanced Custom Fields (ACF)** gratuito.
2. Activar **Vitrina WordCamp** y guardar **Ajustes → Enlaces permanentes** una vez.
3. Crear una página y asignar template **Home WordCamp**.
4. Seleccionarla como página de inicio.
5. Agregar productos desde menú **Productos**. El grupo **Datos del producto** aparece automáticamente.

Los campos están en `acf-json/group_vitrina_producto.json`. En otra instalación, ACF puede pedir sincronizar el grupo desde **ACF → Grupos de campos** para editar su configuración.

Código intencionalmente pequeño. Objetivo: enseñanza, no e-commerce completo.
