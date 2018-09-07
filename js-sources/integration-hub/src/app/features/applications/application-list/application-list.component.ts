import {Component, OnInit} from '@angular/core';
import {ApiModule} from "@app/core/api.module";
import {catchError} from "rxjs/internal/operators";
import {Observable} from "rxjs/index";

@Component({
    selector: 'app-application-list',
    templateUrl: './application-list.component.html',
    styleUrls: ['./application-list.component.css']
})
/**
 * Application list
 */
export class ApplicationListComponent implements OnInit {

    constructor(private apiService: ApiModule) {
    }

    /**
     *
     * @type {Application[]}
     */
    public items = [];

    /**
     * Error list
     * @type {object[]}
     */
    public errors = [];

    ngOnInit() {
        let that = this;
        this.apiService.applications().list()
            .pipe(
                catchError(function (errors) {
                    that.errors = errors;
                    return Observable.create();
                })
            )
            .subscribe(function (items) {
                that.items = items;
            });
    }
}
