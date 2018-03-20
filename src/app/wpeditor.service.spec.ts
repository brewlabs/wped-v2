import { TestBed, inject } from '@angular/core/testing';

import { WpeditorService } from './wpeditor.service';

describe('WpeditorService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [WpeditorService]
    });
  });

  it('should be created', inject([WpeditorService], (service: WpeditorService) => {
    expect(service).toBeTruthy();
  }));
});
