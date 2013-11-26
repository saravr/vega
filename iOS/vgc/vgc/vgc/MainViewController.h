//
//  MainViewController.h
//  vgc
//
//  Created by Sarav Ramaswamy on 11/24/13.
//  Copyright (c) 2013 Simply Hired. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface MainViewController : UIViewController <UITableViewDataSource> {
    
}
@property (strong, nonatomic) NSArray *itemsArray;
@property (strong, nonatomic) NSString *category;
@property (weak, nonatomic) IBOutlet UIButton *addButton;

@property (weak, nonatomic) IBOutlet UITableView *mainTableView;

@end
