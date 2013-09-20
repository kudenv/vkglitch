Подключить библиотеки ./lib
инециализировать объект класса Vktoken(code_app,req_url,secret_code)
получить code для получения access-token getCode()
для получения ответа  авторизаци getAuthUrl() - генерит сылку для атоизации для получения ответа с кодом автоизации
получения  ответа авторизации получения acess_token VK getToken()
работа с методами VK getRequest() -> method (метод API VK); params (массив параметров для методов)