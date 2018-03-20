import { Component, OnInit } from '@angular/core';
import { WpeditorService } from '../wpeditor.service';
import {FormControl, Validators} from '@angular/forms';

@Component({
  selector: 'app-settings',
  templateUrl: './settings.component.html',
  styleUrls: ['./settings.component.css']
})



export class SettingsComponent implements OnInit {

  constructor(private winRef: WpeditorService) { }

 emailFormControl = new FormControl('', [
    Validators.required,
    Validators.email,
  ]);

  ngOnInit() {
 var d = this.winRef.nativeWindow.wp;
      console.log(d);
      var x = d.editor;
      console.log(x);
      x.initialize("mytester");
    
  }
  ngAfterViewInit(){
      var d = this.winRef.nativeWindow.wp;
      console.log(d);
      var x = d.editor;
      console.log(x);
      x.initialize("mytester");
  }
  ngAfterContentChecked(){

  }

  ngOnDestroy(){
    this.winRef.nativeWindow.wp.editor.remove("mytester");
  }
}
