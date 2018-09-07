import { TestBed, inject } from '@angular/core/testing';

import { LocalUserService } from './local-user.service';

describe('LocalUserService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [LocalUserService]
    });
  });

  it('should be created', inject([LocalUserService], (service: LocalUserService) => {
    expect(service).toBeTruthy();
  }));
});
