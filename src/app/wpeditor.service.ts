import { Injectable } from '@angular/core';


function _wp() : any {
   // return the global native browser window object
   return window;
}

@Injectable()
export class WpeditorService {

  constructor() { }

  get nativeWindow() : any {
      return _wp();
   }

}
