<?php

    namespace SAC_WebAPI\DataAccess;

    use SAC_WebAPI\Model\Ticket;

    include_once './Models/Ticket.php';

    class DataAccess{

        private $host;
        private $user;
        private $password;
        private $database;
        private $conn;

        function __construct(){
            $this->host = $_ENV["SAC_DB_HOST"];
            $this->user = $_ENV["SAC_DB_USER"];
            $this->password = $_ENV["SAC_DB_PASSWORD"];
            $this->database = $_ENV["SAC_DB_NAME"];

            $this->conn = new \mysqli($this->host, $this->user, $this->password, $this->database);
            if ($this->conn->connect_errno) {
		$aux = $this->conn->connect_error;
		throw new \Exception("$aux");
            }
        }

        public function abrirTicket($ticket){
            $sql = "INSERT INTO sac_web_api.ticket 
                        (ticket_id,nome,email,telefone,mensagem,assunto)
                    VALUES
                        (?,?,?,?,?,?);";
            
            $stmt = $this->conn->prepare($sql);

            if(!$stmt){
                return 0;
            }

            $stmt->bind_param("ssssss",$ticket->ticketId,$ticket->nome,$ticket->email,$ticket->telefone,$ticket->mensagem,$ticket->assunto);
            $stmt->execute();
            $stmt->close();

            return 1;
        }

        public function getTodosTickets(){
            $sql = "SELECT
                        ticket_id TicketId,
                        nome NomeDeUsuario,
                        email Email,
                        telefone Telefone,
                        mensagem Mensagem,
                        aberto Aberto,
                        assunto Assunto
                    FROM
                        sac_web_api.ticket;";

	    $result = $this->conn->query($sql);

	    if($result === null){ // Problema de comunicação com o bd
		$this->conn->close();                	
		return 0;
            }

	    $result = $result->fetch_all();
 
            $this->conn->close();
            	
            return $result;
        }

        public function fecharTicket($id){
            $sql = "UPDATE sac_web_api.ticket SET aberto = '0' WHERE ticket_id = ?";

            $stmt = $this->conn->prepare($sql);
        
            if(!$stmt){
                return 0;
            }

            $stmt->bind_param("s",$id);
            $stmt->execute();
            $stmt->close();

            return $id;
        }

        public function excluirTicket($id){
            $sql = "DELETE FROM sac_web_api.ticket WHERE ticket_id = ?";

            $stmt = $this->conn->prepare($sql);

            if(!$stmt){
                return 0;
            }
            
            $stmt->bind_param("s",$id);
            $stmt->execute();
            $stmt->close();

            return $id;         
        }

    }

?>
