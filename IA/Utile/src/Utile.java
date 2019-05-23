import java.util.*;

public class Utile {
    public static ArrayList<String> getListe(int index, String ah) {//Permet d'obtenir toutes les possibilitées sous la forme d'une Liste avec 1 pour true et 0 pour false
        ArrayList<String> list = new ArrayList<>();
        if (index == 0) {
            list.add(ah);
            return list;
        }

        list.addAll(getListe(index - 1, ah + "0"));
        list.addAll(getListe(index - 1, ah + "1"));
        return list;
    }

    /**
     * Compare deux HashMap
     * @param h1
     * @param h2
     * @return vrai si elles sont égales
     */
    public static boolean hashmapEquals(HashMap<String,Integer> h1, HashMap<String,Integer> h2){
        for(Map.Entry<String, Integer> entry : h1.entrySet()) {
            String key = entry.getKey();
            Integer value = entry.getValue();
            if(!h2.containsKey(key) || h2.get(key) != value)
                return false;
        }
        return true;
    }
    public static void afficher(HashMap<String,Integer> h){
        for(Map.Entry<String, Integer> entry : h.entrySet()) {
            String key = entry.getKey();
            Integer value = entry.getValue();
            System.out.println("CLE   " + key + "    nombre   "+ value);
        }
    }
    public static void afficherCase(HashMap<Case,Integer> h){
        for(Map.Entry<Case, Integer> entry : h.entrySet()) {
            Case key = entry.getKey();
            Integer value = entry.getValue();
            System.out.println("CLE   " + key + "    nombre   "+ value);
        }
    }
    public static HashMap trierUneHashMap(HashMap map) {
        List list = new LinkedList(map.entrySet());
        // Defined Custom Comparator here
        Collections.sort(list, new Comparator() {
            @SuppressWarnings("rawtypes")
            public int compare(Object o1, Object o2) {
                return ((Comparable) ((Map.Entry) (o1)).getValue())
                        .compareTo(((Map.Entry) (o2)).getValue());
            }
        });

        // Here I am copying the sorted list in HashMap
        // using LinkedHashMap to preserve the insertion order
        HashMap sortedHashMap = new LinkedHashMap();
        for (Iterator it = list.iterator(); it.hasNext();) {
            Map.Entry entry = (Map.Entry) it.next();
            sortedHashMap.put(entry.getKey(), entry.getValue());
        }
        return sortedHashMap;
    }
}
