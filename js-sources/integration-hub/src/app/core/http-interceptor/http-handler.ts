import {Injectable, Injector} from '@angular/core';
import {throwError} from "rxjs/index";
import {Router} from "@angular/router";

@Injectable({
    providedIn: "root"
})
export class ErrorHandler {

    constructor(private router: Router) {
    }

    public handleError(err: any) {
        console.log(err);
        if (this.router.url !== '/login') {
            this.router.navigate(["/login"]);
        }

        return throwError(err.error);
    }
}