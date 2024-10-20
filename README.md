# VERSIONES
PHP 8.1.10
Laravel 10.0.0
Breeze 1.29.1
Livewire 3.5.4
Spatie 6.9.0
DeepL Api 

# INSTALACION E INICIALIZACIÓN
Para esta guía se utiliza Laragon 
1. Clonar el repositorio o descargarlo como archivo comprimido desde https://github.com/Morkros/ChatGO.
2. Una vez clonado el repositorio o descomprimidos los archivos, colocar la carpeta que contenga la aplicación dentro de la carpeta laragon/www.
3. realizar una copia del archivo ".env.example" y cambiar su nombre a ".env" (sin comillas).
4. Iniciar Laragon y abrir una terminal.
5. Ingresar la linea "cd chatgo" (sin comillas), reemplazando "chatgo" por el nombre de la carpeta que contenga la aplicación.
6. Ingresar la linea "composer install" seguido de "npm install" (ambas lineas sin comillas) para descargar las dependencias necesarias para el funcionamiento de la aplicación.
7. Utilizar la linea "php artisan migrate" (sin comillas) para generar la base de datos.
8. Abrir otra terminal, e ingresar "php artisan serve" en un terminal y "npm run dev" en la otra, esto permitirá ingresar a la aplicación.
9. Utilizando un navegador (Edge, Chrome, Firefox) ingresar a 127.0.0.1:8000.

# VISTAS Y FUNCIONES PRINCIPALES
- **REGISTER**:
  - Al hacer click en **"REGISTER"**, permitirá al usuario ingresar sus datos y registrarse en la web.
  - Datos requeridos:
    - Nombre de usuario
    - Correo electrónico
    - Contraseña
    - Idioma preferido para enviar y recibir mensajes
  - Después de registrarse, el sistema enviará un enlace al correo ingresado para verificar la cuenta del usuario.

- **LOG IN**:
  - Al hacer click en **"LOG IN"**, el sistema pedirá al usuario que ingrese su correo y su contraseña.
  - Si la cuenta no ha sido verificada, se mostrará un botón para reenviar el correo de verificación.

- **DASHBOARD**:
  - Muestra el listado de chats que posee el usuario, al hacer click en uno de los chats, permitirá enviar y recibir mensajes en el idioma seleccionado por el usuario.
  - Al clickear en el botón **"CONTACTS LIST"** en la barra de navegación, se ira a dicha ventana.
  - del lado superior derecho se encuentra el nombre del usuario, al hacer click en el mismo desplegará un menú donde se podrá editar el perfil del usuario y desconectarse.

  **CONTACTS LIST**:
  -Al hacer click en en el botón "agregar" se mostrará un panel que requerirá un nombre y un correo electrónico (perteneciente a otro usuario), si los datos ingresados son correctos, se añadirá un nuevo contacto a su listado.
  - Junto a cada contacto, sobre el lado derecho, se encuentran los botones de "editar contacto" y "eliminar contacto".

**PROFILE**:
- Permite cambiar el nombre de usuario, correo electronico asociado a la cuenta, contraseña, lenguaje de los mensajes enviados y recibidos.
- Al final de la vista se encuentra el botón para eliminar la cuenta de forma PERMANENTE.


