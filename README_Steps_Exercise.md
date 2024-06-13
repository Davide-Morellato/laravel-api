1. Creo ProjectController nella cartella Api php artisan make:controller Api/ProjectController

2. Dichiaro la p.f. index() in cui prendo tutti i progetti e mi restituisco una response in formato json, al cui interno passo come parametro un array associativo contente come chiave 'projects' e come valore la variabile in cui ho salvato la collection dei projects ($projects)

3. Nella cartella routes apro il file api.php e, dopo aver importato il ProjectController della cartella Api, dichiaro la rotta per la chiamata API, mediante il metodo statico get
Route::get('/projects', [ProjectController::class, 'index']);

4. Testo l'url su Postman (http://127.0.0.1:8000/api/projects)

5. CREO LA SECONDA REPO: vite-boolfolio (e lavoro su quella)

6. BONUS: paginazione->nel ProjectController applico l'eadger loading sfruttando il metodo with() ed invoco il metodo paginate(), dichiarando quanti elementi voglio visualizzare in pagina nell'altra REPO (lavoro su quella dal punto 15.)

-- PARTE 2 --

7. BONUS 2: Nel ProjectController Ho dichiarato una p.f. singleProject() in cui prendo il singolo progetto e mi restituisco una response in formato json, al cui interno passo come parametro un array associativo contente come chiave 'project' e come valore la variabile in cui ho salvato il project ($project) e in api.php ho registrato una nuova rotta parametrica per la chiamata API
[Route::get('/projects/{project}', [ProjectController::class, 'singleProject']);]