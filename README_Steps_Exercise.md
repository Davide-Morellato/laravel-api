1. Creo ProjectController nella cartella Api php artisan make:controller Api/ProjectController

2. Dichiaro la p.f. index() in cui prendo tutti i projetti e mi restituisco una response in formato json, al cui interno passo come parametro un array associativo contente come chiave 'projects' e come valore la variabile in cui ho salvato la collection dei projects ($projects)

3. Nella cartella routes apro il file api.php e, dopo aver importato il ProjectController della cartella Api, dichiaro la rotta per la chiamata API, mediante il metodo statico get
Route::get('/projects', [ProjectController::class, 'index']);

4. CREO LA SECONDA REPO vite-boolfolio