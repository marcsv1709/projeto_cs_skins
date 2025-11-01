<?php
class DataBase {
    
    private $PDO;

    public function __construct() {
        try {
            // AJUSTE 1: String de conexão (DSN) limpa, sem espaços
            // e com o charset (utf8mb4) definido diretamente.
            $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
            
            // AJUSTE 2: Opções recomendadas para o PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,     // Lança exceções em caso de erro no SQL
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,         // Define 'FETCH_ASSOC' como padrão
                PDO::ATTR_EMULATE_PREPARES   => false,                    // Usa "prepared statements" reais do MySQL
            ];

            // AJUSTE 3: Cria a conexão PDO sem o 'MYSQL_ATTR_INIT_COMMAND'
            $this->PDO = new PDO($dsn, DB_USER, DB_PASS, $options);

        } catch(PDOException $ex) {
            // AJUSTE 4: Tratamento de erro seguro.
            
            // 1. Loga o erro real no servidor (você verá isso nos logs do Railway)
            // Isso esconde detalhes sensíveis (como senha) do usuário final.
            error_log("Erro de conexão PDO: " . $ex->getMessage());
            
            // 2. Mostra uma mensagem genérica e amigável para o usuário
            http_response_code(500); // Define o código de erro HTTP para "Erro Interno do Servidor"
            die("<h2>Erro de Conexão</h2><p>Não foi possível conectar ao banco de dados. Por favor, tente novamente mais tarde.</p>");
        }
    }

    /**
     * Executa uma consulta SELECT e retorna todos os resultados.
     */
    public function select($query, $bindings = []) {
        $STH = $this->PDO->prepare($query);
        $STH->execute($bindings);
        
        // Retorna os resultados. Já virá como FETCH_ASSOC por causa das opções no construtor.
        // Se não houver resultados, ele retorna um array vazio [], que é o ideal.
        return $STH->fetchAll();
    }

    /**
     * Executa uma consulta que não retorna dados (INSERT, UPDATE, DELETE).
     * Retorna true em sucesso ou lança uma exceção em caso de falha.
     */
    public function query($query, $bindings = []){
        $STH = $this->PDO->prepare($query);
        return $STH->execute($bindings);
    }
}