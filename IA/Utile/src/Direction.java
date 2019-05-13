/**
 * This enumeration lists all the directions possible for a moving entity based on the cardinal points and their inter-cardinal points
 */
public enum Direction {
    N(-1, 0), NW(-1, 1), W(0, 1), SW(0, 0), S(1, 0), SE(1, -1), E(0, -1), NE(-1, -1);

    private int line, column;

    Direction(int line, int column){
        this.line = line;
        this.column = column;
    }

    /**
     * Returns a number indicating how to move on an y axis
     * @return A number indicating how to move on an y axis
     */
    public int getLine() { return line; }

    /**
     * Returns a number indicating how to move on an x axis
     * @return A number indicating how to move on an x axis
     */
    public int getColumn() { return column; }
}
