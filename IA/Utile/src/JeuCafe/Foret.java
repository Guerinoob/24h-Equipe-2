package JeuCafe;

/**
 * 
 */
public class Foret extends Unite {

    /**
     * Default constructor
     */
    public Foret(int lig, int col) {
        super(lig, col);
    }

	public Foret(Foret foret) {
		super(foret);
	}

    public String toString() {
    	return "F";
    }

}