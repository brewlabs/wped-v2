import { Component , OnInit } from '@angular/core';
import { TranslateService } from './translations/translate.service';
import { TranslateModel } from './translations/translate.model';
import { Router } from '@angular/router';


import { DashboardComponent } from './dashboard/dashboard.component';
import { SettingsComponent } from './settings/settings.component';
import { SetupComponent } from './setup/setup.component';

import { RouterModule, Routes } from '@angular/router';

import { WpeditorService } from './wpeditor.service';


@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})



//https://stackblitz.com/edit/passing-data-between-components-in-router-outlet-to-outside?file=app%2Fapp.component.html

export class AppComponent {
 
  title = 'Awesomeness';
  textModel: TranslateModel;
  activeLinkIndex = -1;
  navLinks: any[];
    
  constructor(textProvider: TranslateService,private router: Router, private window: WpeditorService) {
    this.textModel = textProvider.getText();
    console.log('app ish' );
    console.log(this.textModel['Dashboard'] );
    
    if(window.nativeWindow.adminapp.isSetup){
        this.navLinks = [
        { path: 'dashboard', component: DashboardComponent , data : { title: this.textModel['Dashboard'] }},
        { path: 'settings',      component: SettingsComponent , data : { title: this.textModel['Settings'] } },
      ];
    
    } else {
      this.navLinks = [
        { path: 'setup', component: SetupComponent , data : { title: 'Setup' }}
      ];
    }

    
  }
 

 
}
