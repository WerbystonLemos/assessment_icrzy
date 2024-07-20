# CONSIDERAÇÕES DO DEV
Nessa aplicação, optei por não por as regras de negócios referente à chamada Ajax na controller pois, por mais que seja uma aplicação simples, pensei em adotar a estratégia que seria adotada em uma situação real afim de evitar repetição de código e reaproveitamento. Então, criei um Helper (app/Helpers/AjaxCurl.php) quer esteja disponível para  qualquer classe que necessitasse fazer uso do cURL para uma chamada Ajax, assim, já estaria pré-pronta e pouparia tempo e manutenção.
***Obs:. o teste optava por usar Laravel ou Lumen. Como optei por Laravel usei o arquivo de rotas api.php, então deve-se usar o endpoit acrescido de '/api' (/api/search/local/01001000,17560-246)***

# MISSÃO
## Teste - Desenvolvedor backend
Nesse teste será proposta a criação de uma API para realizar a consulta de vários CEPs no ViaCEP e fazer o retorno dos dados da maneira proposta. A seguir você poderá ver a descrição detalhada do que deverá ser entregue, não se esqueça de organizar bem o seu código, e tenha um bom teste 🙂​
Crie um novo projeto de API em Lumen ou Laravel, nele defina uma nova rota GET correspondente a o caminho `/search/local/CEP-1,CEP-2…`.
No controlador dessa rota use a API do ViaCEP para realizar e armazenar em array a consulta de cada.
Reorganize os dados dos endereços para que quando acessado `/search/local/01001000,17560-246` a API retorne um JSON exatamente assim:

    [
        {
            "cep": "17560246",
            "label": "Avenida Paulista, Vera Cruz",
            "logradouro": "Avenida Paulista",
            "complemento": "de 1600/1601 a 1698/1699",
            "bairro": "CECAP",
            "localidade": "Vera Cruz",
            "uf": "SP",
            "ibge": "3556602",
            "gia": "7134",
            "ddd": "14",
            "siafi": "7235"
        },
        {
            "cep": "01001000",
            "label": "Praça da Sé, São Paulo",
            "logradouro": "Praça da Sé",
            "complemento": "lado ímpar",
            "bairro": "Sé",
            "localidade": "São Paulo",
            "uf": "SP",
            "ibge": "3550308",
            "gia": "1004",
            "ddd": "11",
            "siafi": "7107"
        }
    ]
