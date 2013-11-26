//
//  AddViewController.h
//  vgc
//
//  Created by Sarav Ramaswamy on 11/25/13.
//  Copyright (c) 2013 Simply Hired. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface AddViewController : UIViewController <UITableViewDataSource> {
    
}

@property (strong, nonatomic) NSArray *itemsArray;
@property (strong, nonatomic) NSString *category;
@property (weak, nonatomic) IBOutlet UITableView *addTableView;

@end
