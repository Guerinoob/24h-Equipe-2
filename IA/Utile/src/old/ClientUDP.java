package old;

import java.io.IOException;
import java.net.*;

public class ClientUDP {

    private InetAddress serveur;
    private int port;

    private DatagramSocket socket;

    private DatagramPacket sender;
    private DatagramPacket response;

    private byte[] buffer;

    public ClientUDP() throws SocketException {
        socket = new DatagramSocket();
    }

    public void connect(String address, int port) throws UnknownHostException {
        serveur = InetAddress.getByName(address);
        this.port = port;
    }

    public void send(String message) throws IOException {
        buffer = new byte[1000];
        buffer = message.getBytes();
        sender = new DatagramPacket(buffer, buffer.length, serveur, port);
        socket.send(sender);
    }

    public String receive() throws IOException {
        buffer = new byte[1000];
        response = new DatagramPacket(buffer, buffer.length);
        socket.receive(response);
        return new String(response.getData(), 0, response.getLength());
    }
}
