import { TestBed, inject } from '@angular/core/testing';

import { SwappitAuthGuardService } from './swappit-auth-guard.service';

describe('SwappitAuthGuardService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [SwappitAuthGuardService]
    });
  });

  it('should be created', inject([SwappitAuthGuardService], (service: SwappitAuthGuardService) => {
    expect(service).toBeTruthy();
  }));
});
