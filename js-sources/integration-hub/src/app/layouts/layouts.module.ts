import {NgModule} from '@angular/core';
import {ClearLayoutComponent} from './clear-layout/clear-layout.component';
import {ApplicationLayoutComponent} from './application-layout/application-layout.component';
import {RouterModule} from "@angular/router";
import {FeaturesModule} from "@app/features/features.module";

@NgModule({
    imports: [
        RouterModule,
        FeaturesModule
    ],
    declarations: [ClearLayoutComponent, ApplicationLayoutComponent]
})
export class LayoutsModule {
}
