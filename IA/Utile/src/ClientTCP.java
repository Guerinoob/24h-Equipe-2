import java.io.*;
import java.net.InetAddress;
import java.net.Socket;

/**
 * Class for basic interactions with a TCP Server (send, receive, connect, disconnect...)
 */
public class ClientTCP {

    private Socket server;

    private BufferedReader bufferReceive;
    private BufferedWriter bufferSend;


    /**
     * Contructs the client. This contructor does nothing except returning an client. Use <b>connect</b> to connect to a server
     */
    public ClientTCP() {

    }

    /**
     * Attempts to connect to a server using its address and port. If the client is already connected to a server, he'll be disconnected.
     * @param ip_address IP Address of the server
     * @param port The port to connect to
     * @throws IOException If there's any error (connection failed, server not launched...)
     */
    public void connect(String ip_address, int port) throws IOException {
        if(server != null && server.isConnected()){
            disconnect();
            server = null;
        }

        server = new Socket(InetAddress.getByName(ip_address), port);

        bufferReceive = new BufferedReader(new InputStreamReader(server.getInputStream()));
        bufferSend = new BufferedWriter(new OutputStreamWriter(server.getOutputStream()));
    }

    /**
     * Read a line sent by the server in the buffer and returns it. <b>This method will block the execution until a message is received</b>
     * @return The server's message
     * @throws IOException If there's any error (not connected for example)
     */
    public String receive() throws IOException {
        return bufferReceive.readLine();
    }

    /**
     * Writes a message in the buffer and sends it to the server
     * @param message The message to send
     * @throws IOException If there's any error (not connected for example)
     */
    public void send(String message) throws IOException {
        bufferSend.write(message);
        bufferSend.flush();
    }

    /**
     * Disconnects the client from the server
     * @throws IOException If there's any error (not connected for example)
     */
    public void disconnect() throws IOException {
        server.close();
        server = null;
    }
}
