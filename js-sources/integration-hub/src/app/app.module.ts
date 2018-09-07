import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {AppComponent} from './app.component';
import {AppRoutingModule} from './app-routing.module';
import {HTTP_INTERCEPTORS} from "@angular/common/http";
import {RequestInterceptor} from "@app/core/http-interceptor/http-interceptor";
import {FeaturesModule} from "@app/features/features.module";
import {LayoutsModule} from "@app/layouts/layouts.module";
import {LocalUserService} from "@app/core/services/local-user.service";
import {CookieService} from "ngx-cookie-service";

@NgModule({
    declarations: [
        AppComponent
    ],
    imports: [
        BrowserModule,
        AppRoutingModule,
        FeaturesModule,
        LayoutsModule
    ],
    providers: [
        {
            provide: HTTP_INTERCEPTORS,
            useClass: RequestInterceptor,
            multi: true,
        },
        LocalUserService,
        CookieService
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}
