//
//  AddViewController.m
//  vgc
//
//  Created by Sarav Ramaswamy on 11/25/13.
//  Copyright (c) 2013 Simply Hired. All rights reserved.
//

#import "AddViewController.h"
#import "AFNetworking/AFJSONRequestOperation.h"

@interface AddViewController ()

@end

@implementation AddViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    self.itemsArray = [[NSArray alloc] init];
    self.category = @"None";
    
    [self loadResults];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

-(void)loadResults
{
    NSString *urlString;
    
    if ([self.category isEqualToString:@"Vehicle"]) {
        urlString = [NSString stringWithFormat:@"http://%@/VegaDB/Vehicle/find", @"127.0.0.1:9000"];
    } else {
        urlString = [NSString stringWithFormat:@"http://%@/VegaDB/Category/?filter_Parent=%@", @"127.0.0.1:9000", self.category];
    }
    NSLog(@"URL: %@", urlString);
    NSURL *url = [NSURL URLWithString:urlString];
    //NSURL *url = [NSURL URLWithString:@"http://127.0.0.1:9000/VegaDB/Category/find"];
    //NSURL *url = [NSURL URLWithString:@"http://ec2-54-219-87-52.us-west-1.compute.amazonaws.com:9000/VegaDB/Vehicle/find"];
    //NSURL *url = [NSURL URLWithString:@"http://localhost:28017/XYZ/Vehicle/?filter_make=Toyota"];
    
    NSURLRequest *request = [NSURLRequest requestWithURL:url];
    //AFNetworking asynchronous url request
    AFJSONRequestOperation *operation = [AFJSONRequestOperation
                                         JSONRequestOperationWithRequest:request
                                         success:^(NSURLRequest *request, NSHTTPURLResponse *response, id responseObject)
                                         {
                                             NSLog(@"JSON RESULT %@", responseObject);
                                             self.itemsArray = [responseObject objectForKey:@"rows"];
                                             [self.addTableView reloadData];
                                         }
                                         failure:^(NSURLRequest *request, NSHTTPURLResponse *response, NSError *error, id responseObject)
                                         {
                                             NSLog(@"Request Failed: %@, %@", error, error.userInfo);
                                         }];
    
    [operation start];
    
}

#pragma mark - Table view data source

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
    // Return the number of sections.
    return 2;
}

- (NSString *)tableView:(UITableView *)tableView titleForHeaderInSection:(NSInteger)section {
    
    switch (section) {
        case 0:
            return @"";
            //return @"Recently Used";
            
        case 1:
            return @"Categories";
            
        default:
            break;
    }
    
    return @"";
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    // Return the number of rows in the section.
    //NSLog(@"COUNT: %lu", [self.itemsArray count]);
    int count = (section == 1) ? [self.itemsArray count] : 0;
    return count;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    static NSString *CellIdentifier = @"Cell";
    UITableViewCell *cell = [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil) {
        cell = [[UITableViewCell alloc] initWithStyle:UITableViewCellStyleValue1 reuseIdentifier:CellIdentifier];
    }
    
    // Configure the cell...
    if (indexPath.section == 1) {
        //cell.contentView.backgroundColor = [UIColor greenColor];
        NSDictionary *tempDictionary= [self.itemsArray objectAtIndex:indexPath.row];
        if ([tempDictionary objectForKey:@"Name"] != [NSNull null]) {
            cell.textLabel.text = [tempDictionary objectForKey:@"Name"];
            cell.detailTextLabel.text = [tempDictionary objectForKey:@"Detail"];
        }
        
        if ([self.category isEqualToString:@"Vehicle"] && [tempDictionary objectForKey:@"_dfld1"] != [NSNull null]) {
            NSLog(@"Here .......");
            NSString *keyfld = [tempDictionary objectForKey:@"_dfld1"];
            if ([tempDictionary objectForKey:keyfld] != [NSNull null]) {
                cell.textLabel.text = [tempDictionary objectForKey:keyfld];
                if ([tempDictionary objectForKey:@"_dfld2"] != [NSNull null]) {
                    NSString *detfld = [tempDictionary objectForKey:@"_dfld2"];
                    
                    cell.detailTextLabel.text = [tempDictionary objectForKey:detfld];
                }
            }
        }
    }
    
    //NSLog(@"INDEX: %lu", indexPath.row);
    return cell;
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Navigation logic may go here, for example:
    // Create the next view controller.
    /*DetailViewController *detailViewController = [[DetailViewController alloc] initWithNibName:@"DetailViewController" bundle:nil];
     
     // Pass the selected object to the new view controller.
     
     // Push the view controller.
     [self.navigationController pushViewController:detailViewController animated:YES];*/
    NSDictionary *tempDictionary= [self.itemsArray objectAtIndex:indexPath.row];
    self.category = [tempDictionary objectForKey:@"Name"];
    
    NSLog(@"Selected ........ %@", self.category);
    if (self.category != NULL) {
        [self loadResults];
    }
}

@end
