from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
import time

# Ruta al ChromeDriver
driver_path = r"C:\webdrivers\chromedriver.exe"

# Configuración de Brave
options = Options()
options.binary_location = r"C:\Users\El apa\AppData\Local\BraveSoftware\Brave-Browser\Application\brave.exe"
options.add_argument("--start-maximized")

# Inicializar driver
service = Service(executable_path=driver_path)
driver = webdriver.Chrome(service=service, options=options)

# Abrir página de login
driver.get("http://localhost/biblioteca/login.php")
time.sleep(1)

# Inputs
email_input = driver.find_element("name", "email")
password_input = driver.find_element("name", "password")
login_button = driver.find_element("tag name", "button")

# funcion de escribir letra x letra
def type_like_human(element, text, delay=0.2):
    for char in text:
        element.send_keys(char)
        time.sleep(delay)

# simular escritura
type_like_human(email_input, "usuario@example.com")
type_like_human(password_input, "123456")

# pausa para dar click
time.sleep(0.5)
login_button.click()


print("Login exitoso ✅")
time.sleep(3)
driver.quit()
