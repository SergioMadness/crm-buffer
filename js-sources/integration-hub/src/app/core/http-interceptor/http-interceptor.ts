import {Injectable} from '@angular/core';
import {
    HttpRequest,
    HttpHandler,
    HttpEvent,
    HttpInterceptor, HttpResponse,
} from '@angular/common/http';
import {Observable} from "rxjs/index";
import {catchError, tap} from "rxjs/internal/operators";
import {ErrorHandler} from "@app/core/http-interceptor/http-handler";
import {environment} from "../../../environments/environment";
import {LocalUserService} from "@app/core/services/local-user.service";

@Injectable()
export class RequestInterceptor implements HttpInterceptor {

    constructor(private errorHandler: ErrorHandler, private localUser: LocalUserService) {
    }

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        let that = this;

        let tokenFromCookies = this.localUser.getToken();
        const newRequest = request.clone({
            headers: request.headers.set(environment.tokenHeader, tokenFromCookies)
        });

        return next.handle(newRequest).pipe(
            tap(function (response) {
                if (response instanceof HttpResponse) {
                    let token = response.headers.get(environment.tokenHeader);
                    let refreshToken = response.headers.get(environment.refreshTokenHeader);

                    if (token && refreshToken) {
                        that.localUser.setTokens(token, refreshToken);
                    }
                }
            }),
            catchError(event => {
                return this.errorHandler.handleError(event);
            })
        );
    }
}