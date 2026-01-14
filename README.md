# icoaraci-db
⚓ IcoaraciDB — O Motor de Persistência Scorpion

O **IcoaraciDB** é a biblioteca de abstração de base de dados do Ecossistema Scorpion. Ele foi desenhado para oferecer uma interface limpa e segura entre a sua aplicação e o banco de dados, utilizando o padrão de identidade visual técnica **JAPURA**.

---

## ✨ Funcionalidades

- **Conexão Segura:** Integração nativa com o `VeroEnv` para ler credenciais do ficheiro `.env`.
- **Auditoria Automática:** Regista cada transação importante através do `CurupiraDoc`.
- **Segurança:** Preparado para prevenir SQL Injection através de métodos sanitizados.

## 🛠️ Instalação via Docas

Adicione ao seu `docas.json`:
```json
"require": {
    "snahar/icoaraci-db": "1.0.0"
}
