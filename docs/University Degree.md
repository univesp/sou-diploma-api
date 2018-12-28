# University Degree API::v1
Todas URIs são relativas à: *http://localhost:8000/api/* no ambiente de desenvolvimento.
### Autorização
Não é requerida autorização.
### HTTP request headers
 - **Content-Type**: application/json
 - **Accept**: application/json
## End-points

HTTP requisição | Descrição | Exemplo
------------- | ------------- | -------------
**GET** /document/{id} | Exibe o estudante pelo id | *http://localhost:3001/api/v1/student/1*
**GET** /documentType/{id} | Exibe os processos do estudante pelo id | *http://localhost:3001/api/v1/student*
**GET** /process |  | *http://localhost:3001/api/v1/grantor*
**GET** /itemAuditProcess/{id} | Exibe o concedente pelo id | *http://localhost:3001/api/v1/grantor/{id}*
**GET** /printType | *http://localhost:3001/api/v1/professor*
**GET** /responsible/{id} | *http://localhost:3001/api/v1/professor/{id}*
**GET** /type | *http://localhost:3001/api/v1/responsible*
**GET** /university/{id} | **
