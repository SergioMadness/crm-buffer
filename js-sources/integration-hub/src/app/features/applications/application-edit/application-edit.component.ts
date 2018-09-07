import {Component, OnInit} from '@angular/core';
import {Application} from "@app/core/models/application";
import {ApiModule} from "@app/core/api.module";
import {catchError} from "rxjs/internal/operators";
import {Observable} from "rxjs/index";
import {ActivatedRoute} from "@angular/router";

@Component({
    selector: 'app-application-edit',
    templateUrl: './application-edit.component.html',
    styleUrls: ['./application-edit.component.css']
})
/**
 * Component to edit application
 */
export class ApplicationEditComponent implements OnInit {

    constructor(private apiModule: ApiModule, private route: ActivatedRoute) {
    }

    public errors = [];

    public messages = [];

    public item: Application = null;

    ngOnInit() {
        this.item = new Application();

        const id = this.route.snapshot.paramMap.get('id');
        if (id) {
            let that = this;
            this.loadApplication(id)
                .pipe(
                    catchError(function (errors) {
                        that.errors = errors;
                        return Observable.create();
                    })
                )
                .subscribe(function (application?: Application) {
                    that.item = application;
                })
        }
    }

    protected loadApplication(id: string): Observable<Application> {
        return this.apiModule.applications().get(id);
    }

    /**
     * Save application
     */
    public save(): void {
        if (this.item.name) {
            let that = this;
            this.apiModule.applications()
                .save(this.item)
                .pipe(
                    catchError(function (errors) {
                        that.errors = errors;
                        return Observable.create();
                    })
                )
                .subscribe(function (item) {
                    that.item = item;
                    that.messages = ['Данные сохранены'];
                });
        }
    }

    /**
     * Regenerate secret key
     */
    public regenerate() {
        let that = this;
        this.apiModule.applications()
            .regenerateKeys(this.item.id)
            .pipe(
                catchError(function (errors) {
                    that.errors = errors;
                    return Observable.create();
                })
            )
            .subscribe(function (item) {
                that.item = item;
                that.messages = ['Ключи обновлены'];
            });
    }

}
