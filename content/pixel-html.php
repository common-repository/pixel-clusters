<style>
.wrap .postbox .inside h1
{
	font-size:28px;
}

.wrap .postbox .inside h3#code-generate
{
	display: inline-block;
	font-size: 18px;
}

.wrap .postbox .inside .mybutton
{
	background: #09F;
	border: 1px solid black;
	border-radius: 10px;
	color: white;
	cursor: pointer;
	font-size: 18px;
	font-weight: 700;
	padding: 4px 15px;
}

.wrap .postbox .inside .mybutton:hover
{
	background: black;
}

.wrap .postbox .inside #success
{
	color: #0C3;
	font-style: 16px;
	font-style: italic;
}

</style>
<div class="wrap">	   	
    
    <div class="postbox">				
        <div class="inside">

            <h1>Pixel Clusters</h1>
        	<hr />
            <h2>Copy Code:</h2>
            <h3 id="code-generate">[cluster]</h3> <button class="mybutton" onclick="pixel_copyToClipboard('#code-generate')">Copy</button> <span id="success"></span>
            
            <table width="100%" border="0" cellpadding="1" cellspacing="1">
            <tr>
                <td width="15%">
                    <label for="mode">Select mode:</label>
                </td>
                <td>
                    <select id="mode" name="mode" onChange="pixel_cluster_code()">
                        <option disabled selected hidden>Select mode:</option>
                        <option value="1">Image, title and excerpt</option>
                        <option value="2">Image, title without excerpt</option>
                        <option value="3">List of titles</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <label for="number">Number of post to show:</label>
                </td>
                <td>
                    <input type="number" min="1" id="number" name="number" value="1" onChange="pixel_cluster_code()" />
                </td>
            </tr>
            <tr>
                <td width="15%">
                    <label for="type">Select type:</label>
                </td>
                <td>
                    <select id="type" name="type" onChange="pixel_cluster_change_type()">
                        <option disabled selected hidden>Select type:</option>
                        <option value="1">Categories</option>
                        <option value="2">Tags</option>
                    </select>
                </td>
            </tr>
            <tr class="type-select" id="type1" style="display: none;">
                <td width="15%">
                    <label for="cat">Select a category:</label>
                </td>
                <td>
                    <?php 
                        wp_dropdown_categories( array(
                            'hide_empty'   		=> true,
                            'name'         		=> 'cat',
                            'id'           		=> 'cat',
                            'hierarchical' 		=> true,
                            'show_option_none' 	=> 'Select category',
                            'orderby'          	=> 'name',
                        ) ); 
                    ?>
                </td>
            </tr>
            <tr class="type-select" id="type2" style="display: none;">
                <td width="15%">
                    <label for="tag">Select a tag:</label>
                </td>
                <td>
                    <?php 
                        wp_dropdown_categories( array(
                            'hide_empty'   		=> true,
                            'name'         		=> 'tag',
                            'id'           		=> 'tag',
                            'hierarchical' 		=> true,
                            'show_option_none' 	=> 'Select tag',
                            'taxonomy'			=> 'post_tag',
                            'orderby'          	=> 'name',
                        ) ); 
                    ?>
                </td>
            </tr>
            </table>    
            
            <p>&nbsp;</p>
            
            <p><strong>Example: [cluster type="1" tag_id="51"  modo="1" numero="2"]</strong></p>
            
            <h2>Type:</h2> 
            <ul>
                <li>1 - Category</li>
                <li>2 - Tag</li>
            </ul>
            
            <h2>tag_id:</h2>
            <p>Reference ID</p>
            
            
            <h2>modo:</h2>
            <ul>
                <li>1 - Image, title and excerpt</li> 
                <li>2 - Image, title without excerpt</li> 
                <li>3 - List of titles</li> 
            </ul>
            
            
            <h2>numero:</h2>
            <p>Number of posts to show</p>
            
		</div>
	</div>

</div>
