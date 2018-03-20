import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { DashboardComponent }   from './dashboard/dashboard.component';
import { SettingsComponent }   from './settings/settings.component';
import { SetupComponent }   from './setup/setup.component';

import { WpeditorService } from './wpeditor.service';


var go = new WpeditorService();

console.log( go.nativeWindow.adminapp );


const mainApp: Routes = [
  { path: 'dashboard', component: DashboardComponent },
  { path: 'settings', component: SettingsComponent },
  { path: '', redirectTo: '/dashboard', pathMatch: 'full' },
];

const starterApp: Routes = [
  { path: 'setup', component: SetupComponent },
  { path: '', redirectTo: '/setup', pathMatch: 'full' },
];

var routes = starterApp;
if(go.nativeWindow.adminapp.isSetup){
  routes = mainApp;
} 
console.log(routes);

@NgModule({
  imports: [ RouterModule.forRoot(routes,{useHash: true}) ],
  exports: [ RouterModule ]
})
export class AppRoutingModule {}