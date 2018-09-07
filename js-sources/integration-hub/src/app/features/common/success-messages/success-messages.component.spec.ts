import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SuccessMessagesComponent } from './success-messages.component';

describe('SuccessMessagesComponent', () => {
  let component: SuccessMessagesComponent;
  let fixture: ComponentFixture<SuccessMessagesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SuccessMessagesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SuccessMessagesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
