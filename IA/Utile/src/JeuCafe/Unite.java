package JeuCafe;
import java.util.*;

/**
 * 
 */
public abstract class Unite {

    private Position position;
    private Parcelle parcelle;

    /**
     * Default constructor
     */
    public Unite(int lig, int col) {
        this.position = new Position(lig, col);
    }

    public Unite(Unite unite){
        this.position = new Position(unite.position);
        this.parcelle = unite.parcelle;
    }


    /**
     * 
     */

    public Parcelle getParcelle(){
        return this.parcelle;
    }

    public void setParcelle(Parcelle parcelle){
        this.parcelle=parcelle;
    }

    /**
     * @return
     */
    public Position getPosition() {
        // TODO implement here
        return position;
    }



    public boolean free(){
        return false;
    }

}