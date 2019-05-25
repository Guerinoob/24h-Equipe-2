package JeuCafe;
import java.util.*;

/**
 * 
 */
public abstract class Unite {

    private Position position;
    private Parcelle parcelle;
    private Graine graine;

    /**
     * Default constructor
     */
    public Unite(int lig, int col) {
        this.position = new Position(lig, col);
        graine = null;
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
        return this.position;
    }

    /**
     * @return
     */
    public boolean occupee() {
        return graine != null;
    }

    public Graine getGraine() {
        return this.graine;
    }


}