## CircleLink Health task 
Its a web app that does the Following

* Displays patients' data (with sort - search features)
* Creates New Patient 
* Updates Patients' Blood Pressure
* Exports patients' data in a csv file (using Queues)

###Installation

after you `clone` the project you need to do the Following

* Create `.env` file and copy its data from `.env-example`
* Run `php artisan key:generate`
* Run `composer install`
* Run `npm install && npm run dev`
* Run `php artisan migrate --seed`
* Run `php artisan serve`

