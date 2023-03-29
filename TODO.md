# Example of TODO.md

### TODO

- [ ] Integrar a aplicação ao Laravel Horizon para o monitoramento das queues;
- [ ] Utilizar o supervisord para o gerenciamento dos serviços necessários para o desenvolvimento e a execução do projeto;
- [ ] Utilizar elasticsearch para busca otimizada de pacientes;
- [ ] Utilizar para banco de dados PostgreSQL e Redis (Cache e Queue).

### In Progress




### Done

- [x] Utilizar algum padrão para commits;
- [x] Utilizar migration, factory, faker e seeder.
- [x] Criar um endpoint para consulta de CEP que implemente a API do ViaCEP e faça cache (Redis) dos dados para futuras consultas.
- [x] Possuir cobertura de testes unitários de 80% do código (PHP Unit);
- [x] Criar um endpoint que faça importação de dados (pacientes) via arquivo .csv e seja processada em queue assincronamente.
- [x] Criar um endpoint para listagem onde seja possível consultar pacientes pelo nome ou CPF.
- [x] Criar um endpoint para obter os dados de um único pacientes (paciente e seu endereço).
- [x] Criar endpoints de cadastro e atualização de paciente, contendo os campos e suas respectivas validações (Obs: use tudo que o framework(Laravel) te oferece para não criar códigos repetidos e desnecessários):
Foto do Paciente;
Nome Completo do Paciente;
Nome Completo da Mãe;
Data de Nascimento;
CPF;
CNS;
- [x] Endereço completo, (CEP, Endereço, Número, Complemento, Bairro, Cidade e Estado)*;
- [x] Criar um endpoint para excluir um paciente (paciente e seu endereço).
- [x] Utilizar docker e docker-compose para execução do projeto (queremos avaliar seu conhecimento, seja criativo e não use o Laravel Sail).
- [x] Obrigatoriamente para o desenvolvimento do back-end utilizar o framework Laravel.
- [x] Obrigatoriamente a API deve estar nos padrões RESTful.
- [x] Desenvolver uma listagem de pacientes com busca, do qual deve-se permitir a adição, edição, visualização e exclusão de cada um dos pacientes.
- [x] Cada paciente deve ter um endereço cadastrado em uma tabela à parte.
- [x] Paginar a listagem de pacientes;


