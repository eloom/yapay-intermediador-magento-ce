# Yapay Intermediador de Pagamentos para Magento

Este projeto processa pagamento através da Yapay, na opção **Intermediador**.

A Yapay é uma empresa de soluções de pagamentos. É uma unidade de negócios pertencente a Locaweb.

## Recursos

- [x] processa pagamentos nos ambientes **Sandbox** e **Produção** da Yapay

- [x] permite escolher os status de pedido para **novos pedidos** e para **pedidos aprovados**

- [x] sincronização automática dos status de pagamento do pedido. A sincronização ocorre no sentido Yapay -> Loja Magento

- [x] sincronização manual do pagamento nos detalhes do pedido. A sincronização ocorre no sentido Yapay -> Loja Magento

#### Pagamentos com **Cartões de Crédito**

- [x] forma de recebimento por **antecipação** e no **fluxo**

- [x] desconto à vista

- [x] juros ao mês para recebimentos por **antecipação**

- [x] instruções ao cliente que são inseridas no checkout

- [x] valor da parcela mínima

- [x] total de parcelas

- [x] total de parcelas sem juros
 
#### Pagamentos com **Boleto Bancário**

- [x] instruções ao cliente que são inseridas no checkout

- [x] permite configurar o cancelamento dos pedidos automaticamente por compras realizadas **na sexta-feira**, **no sábado** e **entre domingo e quinta-feira**

#### Pagamentos com **Televendas**

Opção que o lojísta pode gerar o pedido pela administração do Magento. Um link é enviado automaticamente ao cliente.

## Perguntas Frequentes


## Dependências


O módulo de pagamento Yapay Intermediador para Magento precisa do módulo [Bootstrap para Magento CE](https://github.com/eloom/bootstrap-magento-ce)

O módulo de pagamento Yapay Intermediador para Magento funciona apenas no [Checkout para Magento CE](https://github.com/eloom/checkout-magento-ce)


## Compatibilidade

- [x] Magento 1.9.3.x

- [x] PHP/PHP-FPM 5.6

## Começando

Os projetos da élOOm utilizam o [Apache Ant](https://ant.apache.org/) para publicar o projeto nos ambientes de **desenvolvimento** e de **teste** e para gerar os pacotes para o **ambiente de produção**.

- Publicando no **ambiente local**

	- no arquivo **build-desenv.properties**, informe o path do **Document Root** na propriedade "projetos.path";
	
	- na raiz deste projeto, execute, no prompt, o comando ```ant -f build-desenv.xml```.
	
	
	> a tarefa Ant irá copiar todos os arquivos do projeto no seu Magento e limpar a cache.
	

- Publicando para o **ambiente de produção**

	- na raiz deste projeto, execute, no prompt, o comando ```ant -f build-producao.xml```.
	
	
	> a tarefa Ant irá gerar um pacote no formato .zip, no caminho definido na propriedade "projetos.path", do arquivo **build-producao.properties**.

	> os arquivos .css e .js serão comprimidos automáticamente usando o [YUI Compressor](https://yui.github.io/yuicompressor/).
	
## Release Notes

1.0.0 - Lançamento