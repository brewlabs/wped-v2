import { BrowserModule } from '@angular/platform-browser';
import { NgModule, APP_INITIALIZER } from '@angular/core';
import { TranslateService } from './translations/translate.service';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';

import { RouterModule, Routes } from '@angular/router';

import {MatTabsModule} from '@angular/material/tabs';

import { AppRoutingModule } from './app-routing.module';
import { DashboardComponent } from './dashboard/dashboard.component';
import { SettingsComponent } from './settings/settings.component';
import { SetupComponent } from './setup/setup.component';
import { WpeditorService } from './wpeditor.service';

import {MatToolbarModule} from '@angular/material/toolbar';
import {MatSlideToggleModule} from '@angular/material/slide-toggle';
import {MatCardModule} from '@angular/material/card';
import {MatInputModule} from '@angular/material/input';
import {BrowserAnimationsModule} from '@angular/platform-browser/animations';




export function textProviderFactory(provider: TranslateService) {
  return () => provider.load();
}



@NgModule({
  declarations: [
    AppComponent,
    DashboardComponent,
    SettingsComponent,
    SetupComponent
  ],
  imports: [
    RouterModule,
    BrowserModule,
    HttpModule,
    AppRoutingModule,
    MatTabsModule,
    MatToolbarModule,
    MatSlideToggleModule,
    MatCardModule,
    MatInputModule,
    BrowserAnimationsModule

  ],
  providers: [
  ,
    WpeditorService,
    TranslateService, 
    { provide: APP_INITIALIZER, useFactory: textProviderFactory, deps: [TranslateService], multi: true }],
  bootstrap: [AppComponent]
})
export class AppModule { }
