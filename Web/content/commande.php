<div class="container">

    <div class="column is-3 is-offset-3">
        <form method="post" action="#">
        <div class="field">
            <label class="label">Type de café</label>
            <div class="control">
                <div class="select">
                    <select>
                        <option>Robusta</option>
                        <option>Arabica</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="field">
            <label class="label">Origine du café</label>
            <div class="control is-expanded">
                <div class="select is-fullwidth">
                    <select name="country">
                        <option value="Argentina">Argentina</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                    </select>
                </div>
            </div>
        </div>

        <p class="label">Quantité de café </p>
        <div class="field has-addons">


            <div class="control">
                <span class="select">
                  <select>
                    <option>g</option>
                    <option>Kg</option>
                    <option>Tonne</option>
                  </select>
                </span>
            </div>
            <p class="control">
                <input class="input" type="text" name="quantite" placeholder="Quantité">
            </p>
        </div>

        <div class="field">
            <label class="label">Choix de l'exportateur</label>
            <div class="control is-expanded">
                <div class="select is-fullwidth">
                    <select name="country">
                        <option value="Argentina">Argentina</option>
                        <option value="Bolivia">Bolivia</option>
                        <option value="Brazil">Brazil</option>
                        <option value="Chile">Chile</option>
                        <option value="Colombia">Colombia</option>
                        <option value="Ecuador">Ecuador</option>
                        <option value="Guyana">Guyana</option>
                        <option value="Paraguay">Paraguay</option>
                        <option value="Peru">Peru</option>
                        <option value="Suriname">Suriname</option>
                        <option value="Uruguay">Uruguay</option>
                        <option value="Venezuela">Venezuela</option>
                    </select>
                </div>
            </div>
        </div>
        <p class="label"> Date de la commande </p>
        <div>
            <input type="date" name="date" class="form-control" placeholder="date..." value="" />
        </div>

        <br/>


<div class="field is-grouped">
  <div class="control">
    <button class="button is-link">Submit</button>
  </div>
  <div class="control">
    <button class="button is-text">Cancel</button>
  </div>
</div>
        </form>
    </div>
</div>