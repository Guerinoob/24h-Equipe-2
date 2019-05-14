import java.io.*;
import java.net.InetAddress;
import java.net.Socket;

/**
 * Classe proposant les interactions basiques avec un serveur TCP (send, receive, connect, disconnect)
 */
public class ClientTCP {

    private Socket serveur;

    private BufferedReader bufferReceive;
    private BufferedWriter bufferSend;


    /**
     * Construit le client. Ce constructeur ne fait rien à part retourner un client. Utilisez <b>connect</b> pour vous connecter à un serveur
     */
    public ClientTCP() {

    }

    /**
     * Essaies d'établir une connexion à un serveur en utilisant son adresse et son port. Si le client est déjà connecté à un serveur, il sera déconnecté.
     * @param ip_address Adresse IP du serveur
     * @param port Le port auquel se connecter
     * @throws IOException S'il y a une erreur (connexion échouée, serveur non lancée)
     */
    public void connect(String ip_address, int port) throws IOException {
        if(serveur != null && serveur.isConnected()){
            disconnect();
            serveur = null;
        }

        serveur = new Socket(InetAddress.getByName(ip_address), port);

        bufferReceive = new BufferedReader(new InputStreamReader(serveur.getInputStream()));
        bufferSend = new BufferedWriter(new OutputStreamWriter(serveur.getOutputStream()));
    }

    /**
     * Lit une ligne envoyée par le serveur dans le buffer et la retourne. <b>Cette méthode bloquera l'exécution jusqu'à ce qu'un message soit reçu</b>
     * @return Le message du serveur
     * @throws IOException S'il y a une erreur (non connecté par exemple)
     */
    public String receive() throws IOException {
        return bufferReceive.readLine();
    }

    /**
     * Écrit un message dans le buffer et l'envoie au serveur
     * @param message Le message à envoyer
     * @throws IOException S'il y a une erreur (non connecté par exemple)
     */
    public void send(String message) throws IOException {
        bufferSend.write(message);
        bufferSend.flush();
    }

    /**
     * Déconnecte le client du serveur
     * @throws IOException S'il y a une erreur (non connecté par exemple)
     */
    public void disconnect() throws IOException {
        serveur.close();
        serveur = null;
    }
}
