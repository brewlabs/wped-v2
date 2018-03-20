import {Injectable} from '@angular/core';
import {Http} from '@angular/http';
import {TranslateModel} from './translate.model';
import 'rxjs/add/operator/map';

@Injectable()
export class TranslateService {

    private joke: TranslateModel = null;

    constructor(private http: Http) {

    }

    public getText(): TranslateModel {
        return this.joke;
    }

    load() {
        return new Promise((resolve, reject) => {
            this.http
                .get('http://wp.test/wp-json/wped/v1/translate/get')
                .map(res => res.json())
                .subscribe(response => {
                    this.joke = response;
                    console.log(this.joke )
                    resolve(true);
                })
        })
    }
}