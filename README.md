# 123Milhas

Fligt API

Esta API trata de organizar os dados de voos recebidos de uma requisição de forma a agrupa-los a montar grupos com as mesmas tarifas.

Tecnologia Utilizada:

    -   Laravel:8.12.0;
    
Inicio:

    Execute a configuração do ambiente de desenvolvimento usando um servidor da web e as dependencias do PHP;
    Obs.(Certifique-se que você tenha o composer instalado no seu ambiente);
    
Instalaçao do projeto:

    Execute a clonagem do repositório por meio do GitHub:

    git clone https://github.com/Dricacardosos/123Milhas
    
Navegue pelas pastas em seu computador até chegar à pasta clonada:

    cd 123Milhas
    
Use o composer para realizar a instalação:

    composer install
    
Start o servidor:

    php artisan serve
    
End Points

    A requisição a seguir retornar um Json com todas as informações de voos. Usar a posição: "groups" para listar os grupos de voos.
    
    http://localhost/api/fligth
    
