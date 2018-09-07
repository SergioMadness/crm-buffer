import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {ApiModule} from "@app/core/api.module";
import {catchError, tap} from "rxjs/internal/operators";
import {Observable} from "rxjs/index";
import {Router} from "@angular/router";
import {LocalUserService} from "@app/core/services/local-user.service";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
/**
 * Component to display login form and authorize user
 */
export class LoginComponent implements OnInit {

    public form;
    public nameControl;
    public passwordControl;

    public errors = [];

    constructor(private apiService: ApiModule, private router: Router, private localUser: LocalUserService) {
    }

    ngOnInit() {
        if (this.localUser.isAuthorized()) {
            this.router.navigate(["/"]);
        }

        this.form = new FormGroup({
            login: this.nameControl = new FormControl('', [
                Validators.required
            ]),
            password: this.passwordControl = new FormControl('', [
                Validators.required
            ])
        });
    }

    public login(): void {
        if (this.nameControl.valid && this.passwordControl.valid) {
            let that = this;
            this.apiService.authorization().login(this.nameControl.value, this.passwordControl.value)
                .pipe(
                    catchError(function (errors) {
                        console.log(errors);
                        that.errors = errors;
                        return Observable.create();
                    })
                )
                .subscribe(function (data) {
                    that.errors = [];
                    that.router.navigate(['/applications']);
                });
        }
    }
}
